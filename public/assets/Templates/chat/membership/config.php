<?php
	defined('_VALID') or die('Restricted Access!');
  	header("content-type:text/html;charset=utf-8");
  	
	define("DB_HOST","127.0.0.1");
    define("DB_USER","root");
    define("DB_PASS",'root');
    define("DB_NAME","coco");

    define("ENCRYPTION_KEY","7G86q657j4PL03TNOur82q083AA16Ni542kk5v3FO3Z85z386763lC98fCA72U5P");
    define("LANG","en_US");
    
    // DON'T MODIFY BELOW
    define("ROOT",dirname(dirname(__FILE__)));
    define("RELDIR", str_replace('\\','/',substr(dirname(dirname(__FILE__)),strlen($_SERVER['DOCUMENT_ROOT']))));
    define("BASE_URL", ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https" : "http"). "://" . $_SERVER['HTTP_HOST'] . RELDIR);
    require_once( ROOT."/membership/functions.php" );
    require_once( ROOT."/membership/language/".LANG.".php" );
?>