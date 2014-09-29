<?php

    require "Services/Twilio.php";
 
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "AC6efaec04515e614f6e90b9a8962e70cf";
    $AuthToken = "a5be96aee4a2fe8314ba238ebea89486";
 

    $client = new Services_Twilio($AccountSid, $AuthToken);
 
    //get the sender phone number associated with this package
    $people = array(
        "+15026408205" => "Marc Cull"
    );
 
    $message = $_REQUEST['message'];

    foreach ($people as $number => $name) {
 
        $sms = $client->account->messages->sendMessage(
 
        // Step 6: Change the 'From' number below to be a valid Twilio number 
        // that you've purchased, or the (deprecated) Sandbox number
            "646-374-2529", 
 
            // the number we are sending to - Any phone number
            $number,
 
            // the sms body
            $message
        );
 
        // Display a confirmation message on the screen
        echo "Sent message to $name";
    }