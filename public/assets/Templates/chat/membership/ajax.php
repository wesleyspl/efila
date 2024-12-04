<?php
	define('_VALID', TRUE);
	include("config.php");
	
	$return = array("status" => 0, "message" => NULL);

	$action = filter_input(INPUT_GET, 'action');

	if($action == "login"){
		/*
		connect_db();
		$data = array();
		$data['username'] = "hakan";
		$data['password'] = "12345678";
		$data['email'] = "contact@hubanmedia.com";
		$data['role'] = "administrator";
		
		//print_r(add_role($role));
		print_r(add_user($data));
		*/
		//connect_db();
		//print_r(get_user_data("1"));die();
		//perm("index2");die();
		$username = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');

		if(empty($_POST)){
			$return['message'] = t("invalid_method");
		}else{
			connect_db();
			
			if(empty($username)){
				$return['message'] = t("username_empty");
			}elseif(empty($password)){
				$return['message'] = t("password_empty");
			}elseif(!$uid = check_credentials($username,$password)){
				$return['message'] = t("invalid_user");
			}else{
				session_start();
				$user = get_user_data($uid);
				$_SESSION['UID'] = $user['UID'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['name'] = $user['name'];
				$_SESSION['udata'] = mc_encrypt(base64_encode(serialize($user)),ENCRYPTION_KEY);
				//echo base64_decode(mc_decrypt($_SESSION['udata'],ENCRYPTION_KEY));
				$return['message'] = t("welcome_user");
				$return['status'] = 1;
			}
		}

	}elseif($action == "get_userlist"){
		session_start();
		$uid = intval($_SESSION['UID']);
		connect_db();
		$ulist = array();
		$sql = mysql_query("SELECT * from roles");

		while($gr = mysql_fetch_assoc($sql)){
			$q = "SELECT u.UID, u.username, CONCAT(u.first_name, ' ', u.last_name) as name, u.avatar, u.online, (SELECT SUBSTR(l.message,1,30) as msh FROM chat_logs l WHERE l.status != '2' AND ((l.toid = $uid AND l.fromid=u.UID) OR (l.fromid = $uid AND l.toid=u.UID)) ORDER BY l.sent_time DESC LIMIT 1) as message, (SELECT count(*) FROM chat_logs l WHERE l.toid = $uid AND l.fromid=u.UID AND l.status='0' LIMIT 1) as has_unread FROM users u NATURAL JOIN users_roles ur WHERE u.status='1' AND ur.RID='".intval($gr['RID'])."' AND u.UID != '$uid' ORDER BY u.online DESC, u.username ASC";
			//echo $q;
			$sql2 = mysql_query($q);
			$rs = array();
			while($rs[] = mysql_fetch_assoc($sql2)){}
			array_pop($rs);
			$ulist[] = array("name" => $gr['name'], "users" => $rs);
		}
		$return = $ulist;
		mysql_query("UPDATE users SET online='1', last_action='".time()."' WHERE UID=".$uid." AND username='".mysql_real_escape_string($_SESSION['username'])."' LIMIT 1");
		//echo "<pre>";print_r($return);
		unset($ulist);
	}elseif($action == "load_chat"){
		session_start();
		$uid = intval($_SESSION['UID']);
		connect_db();

		$ouid = filter_input(INPUT_GET, 'uid');
		$start = filter_input(INPUT_GET, 'start');
		//$limit = filter_input(INPUT_GET, 'limit');
		$ouid = intval($ouid);

		$start = (!empty($start) && is_numeric($start))?intval($start):0;
		$limit = 50;

		$usql = mysql_query("SELECT u.UID, u.username, CONCAT(u.first_name, ' ', u.last_name) as name, u.avatar, u.online FROM users u WHERE UID=$ouid LIMIT 1");
		$udata = mysql_fetch_assoc($usql);

		$return = $udata;
		$lsql = mysql_query("SELECT l.fromid, l.toid, l.message, l.sent_time, l.status FROM chat_logs l WHERE l.status != '2' and ((l.toid = $uid AND l.fromid=$ouid) OR (l.fromid = $uid AND l.toid=$ouid)) ORDER BY l.sent_time DESC LIMIT $start, $limit");

		while($lg[] = mysql_fetch_assoc($lsql)){}
		array_pop($lg);

		mysql_query("UPDATE users SET online='1', last_action='".time()."' WHERE UID=".$uid." AND username='".mysql_real_escape_string($_SESSION['username'])."' LIMIT 1");
		mysql_query("UPDATE chat_logs l SET l.status='1' WHERE l.toid = $uid AND l.fromid=$ouid AND l.status='0'");
		$return['chat_logs'] = array_reverse($lg);
		$return['start_from'] = $start;
		//echo "<pre>";print_r($return);

	}elseif($action == "send_message"){
		session_start();
		$uid = intval($_SESSION['UID']);
		connect_db();

		$ouid = filter_input(INPUT_POST, 'uid');
		$ouid = intval($ouid);
		$message = filter_input(INPUT_POST, 'message');
		$message = strip_tags($message);
		mysql_query("UPDATE users SET online='1', last_action='".time()."' WHERE UID=".$uid." AND username='".mysql_real_escape_string($_SESSION['username'])."' LIMIT 1");
		if(!empty($ouid) && !empty($message)){
			$message = AutoLinkUrls($message,true);
			mysql_query("INSERT INTO chat_logs SET fromid=$uid, toid=$ouid, status='0', message='".mysql_real_escape_string($message)."', sent_time='".date("Y-m-d H:i:s")."'");
		}
	}elseif($action == "check_messages"){
		session_start();
		$uid = intval($_SESSION['UID']);
		if(isset($_SESSION['lastupdate'])){
			$since = $_SESSION['lastupdate'];
		}else{
			$_SESSION['lastupdate'] = $since = date("Y-m-d H:i:s");
		}
		connect_db();
		$clist = filter_input(INPUT_POST, 'clist');
		/*
		$clist = filter_input(INPUT_POST, 'clist');
		$return = array();
		if(!empty($clist)){
			$clist = explode(",",$clist);
			foreach($clist as $cl){
				$cl = intval($cl);
				$lsql = mysql_query("SELECT l.fromid, l.toid, l.message, l.sent_time, l.status FROM chat_logs l WHERE l.status != '2' AND (l.toid = $uid AND l.fromid=$cl) AND l.sent_time > '$since' ORDER BY l.sent_time DESC");

				while($lg[] = mysql_fetch_array($lsql)){}
				array_pop($lg);
				if(is_array($lg) && count($lg) > 0){
					$return[$cl] = $lg;
				}
			}
		}
		*/
		if(!empty($clist) && is_numeric($clist)){
			mysql_query("UPDATE chat_logs l SET l.status='1' WHERE l.toid = $uid AND l.fromid=$clist AND l.status='0'");
		}
		
		$lsql = mysql_query("SELECT l.fromid, l.toid, CONCAT(u.first_name, ' ', u.last_name) as name, u.avatar, u.online, l.message, l.sent_time, l.status FROM chat_logs l INNER JOIN users u ON u.UID = l.fromid WHERE l.status != '2' AND l.toid = $uid AND l.sent_time > '$since' ORDER BY l.sent_time ASC");
		$resp = array();
		while($rs = mysql_fetch_assoc($lsql)){
			$resp[$rs['fromid']][] = $rs;
		}
		$return = $resp;
		//echo "<pre>";print_r($resp);
		$_SESSION['lastupdate'] = date("Y-m-d H:i:s");
	}else{
		$return['message'] = t("invalid_action");
	}
	echo json_encode($return);
?>