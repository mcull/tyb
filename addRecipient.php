<?php

include "messages.php";
include "senders.php";
include "recipients.php";
 
$senderId= $_REQUEST['sid'];
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$messageId = $_REQUEST['mid'];
$phone = "";

if (strlen($messageId)) {
	$message = getMessage($messageId);
	$phone = $message['caller_id']; 
}
 
if (strlen($senderId) && strlen($name) && strlen($email)) {
 		echo json_encode(addRecipient($senderId,$name,$email,$phone));
}
 
?>
