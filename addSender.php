<?php
include "messages.php";
include "senders.php";
 
$recordingId = $_REQUEST['rid'];
$sms = $_REQUEST['sms'];
$email = $_REQUEST['email'];
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];

$replyToNum = $_REQUEST['replyToNum'];

 
if (strlen($recordingId) && strlen($sms) && strlen($email) && strlen($firstName) && strlen($lastName)) {
  	if (strlen($replyToNum)) {
  		$response = updateMessage($recordingId,"caller_id",$replyToNum);
	}

//		echo json_encode($response);

 		echo json_encode(addSender($recordingId,$sms,$firstName,$lastName,$email));
}
 
?>
