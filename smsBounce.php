<?php

    require "Services/Twilio.php";
    include "messages.php";
    include "senders.php";
    include "util.php";
 
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "AC6efaec04515e614f6e90b9a8962e70cf";
    $AuthToken = "a5be96aee4a2fe8314ba238ebea89486";
 

    $client = new Services_Twilio($AccountSid, $AuthToken);

 
    $body = $_REQUEST['Body'];
    $number = $_REQUEST['From'];

    //use the body to try to look up a sender's message.
    //send back a url to that webpage.

    while (startsWith($body,"0")) {
        $body = substr($body,1);
    }
    $response = shortenUrl("http://54.165.184.141/?id=" . base64_encode($body));

 
    $sms = $client->account->messages->sendMessage(
        "646-374-2529", 
        $number,
        "Welcome!  Click $response to hear the gift message."
    );
    