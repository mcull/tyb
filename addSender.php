<?php
include "messages.php";
include "senders.php";
 
$recordingId = $_REQUEST['rid'];
$sms = $_REQUEST['sms'];
$email = $_REQUEST['email'];
$email = $_REQUEST['firstName'];
$email = $_REQUEST['lastName'];
 
if (strlen($recordingId) && strlen($sms) && strlen($email) && strlen($firstName) && strlen($lastName)) {
 		echo json_encode(addSender($recording_id,$sms,$firstName,$lastName,$email));
}
 
?>
