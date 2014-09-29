<?php

    require "Services/Twilio.php";
    include "messages.php";
    include "senders.php";

    $gifter = getSender($_REQUEST['sid']);

    $giftMessage = getMessage($gifter['recordingId']);
    $gifterPhone = $giftMessage['from'];
    $message = $_REQUEST['message'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $voxMessageId = $_REQUEST['voxId'];

    $voxUrl = getMessage($voxMessageId)['url'];
 
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "AC6efaec04515e614f6e90b9a8962e70cf";
    $AuthToken = "a5be96aee4a2fe8314ba238ebea89486";
 

    $client = new Services_Twilio($AccountSid, $AuthToken);
 
    
 
    $sms = $client->account->messages->sendMessage(
        "646-374-2529", 
        $gifterPhone,
        "Message from $name via ThankYouBack: \"$message\"",
        array($voxUrl)
    );
    echo '{"sucess":"true"}';
?>

    