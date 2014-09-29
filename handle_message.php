<?php
 
require "Services/Twilio.php";
include "messages.php";
 
$url = $_REQUEST['RecordingUrl'];
$caller_id = $_REQUEST['Caller'];
 
if (strlen($url)) {
    //save recording url and callerid as a message 
    $new_id = addMessage($caller_id, $url);
 	
    $response = new Services_Twilio_Twiml();
    $response->say('Thank you.  Your message I D is ' . $new_id . '. Again, the message I D is the number ' . $new_id . '. Good bye');
    print $response;
}
 
?>