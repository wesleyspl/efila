<?php
	defined('_VALID') or die('Restricted Access!');

	// MODELS
	function check_credentials($username,$password){
		$pass = pw_hash($password);
		$sql = mysql_query("SELECT UID FROM users WHERE (username='".mysql_real_escape_string($username)."' || email = '".mysql_real_escape_string($username)."') AND password = '".mysql_real_escape_string($pass)."' AND status='1' LIMIT 1");

		$results = mysql_fetch_array($sql);
		return (int)$results[0];
	}

	function get_user_data($uid){
		$sql = mysql_query("SELECT u.UID, u.username, CONCAT(u.first_name, ' ', u.last_name) as name, u.email, ur.RID as role_id, r.name as role, u.created_at as member_since FROM users u INNER JOIN users_roles ur ON ur.UID = U.UID INNER JOIN roles r ON r.RID = ur.RID WHERE u.UID = '".intval($uid)."' AND u.status='1' GROUP BY u.UID LIMIT 1");
		$results = mysql_fetch_array($sql);
		return (array)$results;
	}

	function add_role($name){
		mysql_query("INSERT INTO roles SET name='".mysql_real_escape_string($name)."', created_at='".date("Y-m-d H:i:s")."', updated_at='".date("Y-m-d H:i:s")."'");
		return mysql_insert_id();
	}

	function add_perm($data){
		mysql_query("INSERT INTO permissions SET perm='".mysql_real_escape_string($data['perm'])."', description='".mysql_real_escape_string(@$data['description'])."', created_at='".date("Y-m-d H:i:s")."', updated_at='".date("Y-m-d H:i:s")."'");
		return mysql_insert_id();
	}

	function attach_perm_to_role($permission,$role){
		if(!check_field_exists($permission, "perm", "permissions")){
			$pid = add_perm(array("perm" => $permission));
		}else{
			$sql = mysql_query("SELECT PID FROM permissions WHERE perm='".mysql_real_escape_string($permission)."' LIMIT 1");
			$rs = mysql_fetch_array($sql);
			$pid = $rs['PID'];
		}

		$rid = get_role_id($role);

		if(empty($rid)){
			return t("role_missing");
		}else{
			mysql_query("INSERT INTO roles_permissions SET RID=$rid, PID=$pid");
			return true;
		}
	}

	function AutoLinkUrls($str,$popup = FALSE){
	    if (preg_match_all("#(^|\s|\()((http(s?)://)|(www\.))(\w+[^\s\)\<]+)#i", $str, $matches)){
	        $pop = ($popup == TRUE) ? " target=\"_blank\" " : "";
	        for ($i = 0; $i < count($matches['0']); $i++){
	            $period = '';
	            if (preg_match("|\.$|", $matches['6'][$i])){
	                $period = '.';
	                $matches['6'][$i] = substr($matches['6'][$i], 0, -1);
	            }
	            $str = str_replace($matches['0'][$i],
	                    $matches['1'][$i].'<a href="http'.
	                    $matches['4'][$i].'://'.
	                    $matches['5'][$i].
	                    $matches['6'][$i].'"'.$pop.'>http'.
	                    $matches['4'][$i].'://'.
	                    $matches['5'][$i].
	                    $matches['6'][$i].'</a>'.
	                    $period, $str);
	        }//end for
	    }//end if
	    return $str;
	}//end AutoLinkUrls

	function get_role_id($name){
		$sql = mysql_query("SELECT RID FROM roles WHERE name='".mysql_real_escape_string($name)."' LIMIT 1");
		$rs = mysql_fetch_array($sql);
		return $rs['RID'];
	}

	function add_user($data){
		$response = array("status" => 0, "message" => NULL);
		if(empty($data['username'])){
			$response['message'] = t('username_empty');
		}elseif(!check_username($data['username'])){
			$response['message'] = t('invalid_username');
		}elseif(check_field_exists($data['username'],"username","users")){
			$response['message'] = t('user_exists');
		}

		if(empty($data['password'])){
			$response['message'] = t('password_empty');
		}elseif(strlen($data['password']) < 8 || strlen($data['password']) > 50){
			$response['message'] = t('password_limit');
		}

		if(empty($data['role'])){
			$response['message'] = t('role_empty');
		}elseif(!check_field_exists($data['role'],"name","roles")){
			$response['message'] = t('role_missing');
		}

		if(!empty($response['message'])){
			return $response;
		}else{
			mysql_query("INSERT INTO users SET username='".mysql_real_escape_string(strtolower($data['username']))."', avatar='".mysql_real_escape_string(@$data['avatar'])."', first_name='".mysql_real_escape_string(@$data['first_name'])."', last_name='".mysql_real_escape_string(@$data['last_name'])."', email='".mysql_real_escape_string($data['email'])."', password='".mysql_real_escape_string(pw_hash($data['password']))."', created_at='".date("Y-m-d H:i:s")."', updated_at='".date("Y-m-d H:i:s")."'");
			if($id = mysql_insert_id()){
				$rid = get_role_id($data['role']);
				mysql_query("INSERT INTO users_roles SET UID=".$id.", RID=".$rid);
				$response['status'] = "1";
				$response['message'] = t("user_add_success");
			}else{
				$response['message'] = t('system_error');
			}
			return $response;
		}
	}

	function check_username($string){
		return !preg_match('/[^a-z_\-0-9]/i', strtolower($string));
	}

	function check_field_exists($string, $var, $table){
		$sql = mysql_query("SELECT count(*) AS total FROM $table WHERE $var='".mysql_real_escape_string(strtolower($string))."' LIMIT 1");
		$rs = mysql_fetch_array($sql);
		return (bool)$rs['total'];
	}

	function perm($permission, $redirect = false){
		if(!isset($_SESSION)) {
		    session_start();
		}

		// Check if user is logged in
		if(empty($_SESSION['UID']) || empty($_SESSION['username']) || empty($_SESSION['udata'])){
			$_SESSION['err'] = t("access_denied");
			if($redirect){
				redirect("login.html");
			}
		}else{
			$udata = @unserialize(base64_decode(mc_decrypt($_SESSION['udata'],ENCRYPTION_KEY)));
			if($udata['username'] != $_SESSION['username']){
				$_SESSION['err'] = t("access_denied");
				if($redirect){
					redirect("login.html");
				}
			}else{
				connect_db();
				//Check Permission
				$sql = mysql_query("SELECT count(*) FROM roles_permissions rp INNER JOIN permissions p ON p.PID = rp.PID WHERE rp.RID=".intval($udata['role_id'])." AND p.perm='".mysql_real_escape_string($permission)."' LIMIT 1");
				$rs = mysql_fetch_array($sql);
				if($rs[0] > 0){
					return true;
				}elseif($redirect){
					$_SESSION['err'] = t("access_denied");
					redirect("login.html");
				}
			}
		}
		
		return false;
	}


	// HELPERS
	function connect_db(){

		if(!$db= @mysql_connect(DB_HOST,DB_USER,DB_PASS)){
		   die("Database connection failed!");
		}
		mysql_select_db(DB_NAME) or die("Database not found!");
		mysql_query("SET NAMES 'utf-8'");
		mysql_query("SET CHARACTER SET utf8");
		mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");

	}

	function check_email($email){
           $email_regexp = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
           return preg_match($email_regexp, $email);
    }

	function t($var){
		global $lang;
		return $lang[$var];
	}

	function dd($data){
		echo "<pre>";var_dump($data);echo "<pre>";die();
	}

	function redirect($url){
      if(headers_sent()){
          echo "<script>document.location.href='".$url."';</script>\n";
      }else{
          header('HTTP/1.1 301 Moved Permanently');
          header('Location: '. $url);
      }
      die();
    }

    function pw_hash($pass){
    	return "!00!:)".substr(hash('sha512', $pass),0,-4);
    }
	// For original source: http://www.warpconduit.net/2013/04/14/highly-secure-data-encryption-decryption-made-easy-with-php-mcrypt-rijndael-256-and-cbc/
	// Encrypt Function
	function mc_encrypt($encrypt, $key){
		$encrypt = serialize($encrypt);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
		$key = @pack('H*', $key);
		$mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
		$passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
		$encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
		return $encoded;
	}

	// Decrypt Function
	function mc_decrypt($decrypt, $key){
		$decrypt = explode('|', $decrypt.'|');
		$decoded = base64_decode($decrypt[0]);
		$iv = base64_decode($decrypt[1]);
		if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
		$key = @pack('H*', $key);
		$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
		$mac = substr($decrypted, -64);
		$decrypted = substr($decrypted, 0, -64);
		$calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
		if($calcmac!==$mac){ return false; }
		$decrypted = unserialize($decrypted);
		return $decrypted;
	} 