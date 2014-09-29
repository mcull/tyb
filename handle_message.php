<?php
 
require "Services/Twilio.php";
include "messages.php";
 
$url = $_REQUEST['RecordingUrl'];
$caller_id = $_REQUEST['Caller'];
 
if (strlen($url)) {
    //save recording url and callerid as a message 
    $new_id = addMessage($caller_id, $url);
 	
    $response = new Services_Twilio_Twiml();
    $response->say('Thank you.  Your message id is ' . $new_id . ' Good bye');
    print $response;
}
 
?>