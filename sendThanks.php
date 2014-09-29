<?php

    require "Services/Twilio.php";
    include "messages.php";
    include "senders.php";

    $gifter = getSender($_REQUEST['rid']);
    $giftMessage = getMessage($gifter['recordingId']);
    $gifterPhone = $giftMessage['caller_id'];
 
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "AC6efaec04515e614f6e90b9a8962e70cf";
    $AuthToken = "a5be96aee4a2fe8314ba238ebea89486";
 

    $client = new Services_Twilio($AccountSid, $AuthToken);
 
    //get the sender phone number associated with this package
    $people = array(
        "+15026408205" => "Marc Cull"
    );
    $number = 
 
    $message = $_REQUEST['message'];
 
    $sms = $client->account->messages->sendMessage(
        "646-374-2529", 
        $gifterPhone,
        $message
    );
    