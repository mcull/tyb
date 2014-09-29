<?php
include "messages.php";
include "senders.php";
 
$recordingId = $_REQUEST['rid'];
$sms = $_REQUEST['sms'];
$email = $_REQUEST['email'];
 
if (strlen($recordingId) && strlen($sms) && strlen($email)) {
 		echo json_encode(addSender($recording_id,$sms,$email));
 	}
}
 
?>