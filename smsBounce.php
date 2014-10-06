<?php

    require "Services/Twilio.php";
 
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "AC6efaec04515e614f6e90b9a8962e70cf";
    $AuthToken = "a5be96aee4a2fe8314ba238ebea89486";
 

    $client = new Services_Twilio($AccountSid, $AuthToken);

 
    $body = $_REQUEST['Body'];
    $number = $_REQUEST['From'];

    //use the body to try to look up a sender's message.
    //send back a url to that webpage.

 
    $sms = $client->account->messages->sendMessage(
        "646-374-2529", 
        $number,
        $body
    );
    