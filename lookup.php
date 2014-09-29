<?php
include "messages.php";
include "senders.php";
 
$id = $_REQUEST['id'];
$type = $_REQUEST['t'];
 
if (strlen($id)) {
	if ("sender" == $type) {
		echo json_encode(getSender($id));
	} else {
    	//return a valid message as json
    	$message = getMessage($id);
 		echo json_encode($message);
 	}
}
 
?>