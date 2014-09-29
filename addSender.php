<?php
include "messages.php";
include "senders.php";
 
$recordingId = $_REQUEST['rid'];
$sms = $_REQUEST['sms'];
$email = $_REQUEST['email'];
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
 
if (strlen($recordingId) && strlen($sms) && strlen($email) && strlen($firstName) && strlen($lastName)) {
 		echo json_encode(addSender($recordingId,$sms,$firstName,$lastName,$email));
}
 
?>
