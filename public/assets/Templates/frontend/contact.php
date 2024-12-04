<?php
	error_reporting(0);
	// check if fields passed are empty
	if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
		echo "0";
	}
		
	$name = $_POST['name'];
	$email_address = $_POST['email'];
	$message = $_POST['message'];
		
	// create email body and send it	
	$to = 'hakankozakli@gmail.com'; // put your email
	$email_subject = "Contact form submitted by: $name";
	$email_body = "You have received a new message. \n\n".
					  " Here are the details:\n \nName: $name \n ".
					  "Email: $email_address\n Message \n $message";
	$headers = "From: ".$to."\n";
	$headers .= "Reply-To: $email_address";	
	mail($to,$email_subject,$email_body,$headers);
	echo "1";
	die();			
?>