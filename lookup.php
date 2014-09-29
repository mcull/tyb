<?php
include "messages.php";
 
$id = $_REQUEST['messageId'];


 
if (strlen($id)) {
	$id = $id - 2974;
    //return a valid message as json
    $message = getMessage($id);
 	echo json_encode($message);
}
 
?>