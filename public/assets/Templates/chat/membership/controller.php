<?php
    define('_VALID', TRUE);
    include("config.php");

    $file = filter_input(INPUT_GET, 'file');
	session_start();
	connect_db();
	
	/*
	$data = array();
	$data['username'] = "demo8";
	$data['password'] = "12345678";
	$data['first_name'] = "demo8";
	$data['last_name'] = "user";
	$data['avatar'] = "images/users/chat/8.jpg";
	$data['email'] = "contact8@hubanmedia.com";
	$data['role'] = "Sales User";
	
	//print_r(add_role($role));
	print_r(add_user($data));
	*/
    //$role = "administrator";
    //attach_perm_to_role($file,$role);
    //echo $file;die();

    if(!in_array($file,array("login","register"))){
    	perm($file, true);
		mysql_query("UPDATE users SET online='2' WHERE last_action BETWEEN ".strtotime("-15 minutes")." AND ".strtotime("-5 minutes"));
		mysql_query("UPDATE users SET online='0' WHERE last_action < ".strtotime("-15 minutes")."");
	}
	
    require_once("../".$file.".html");
    die();
?>