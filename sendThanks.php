<?php

    require "Services/Twilio.php";
    include "messages.php";
    include "senders.php";

    function shortenUrl($url) {

        // Get API key from : http://code.google.com/apis/console/
        $apiKey = 'MyAPIKey';

        $postData = array('longUrl' => $url, 'key' => 'AIzaSyCqzoVivkKMpHK48Xxa5qPSccMSAUrkyfY');
        $jsonData = json_encode($postData);

        $curlObj = curl_init();

        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

        $response = curl_exec($curlObj);

        // Change the response json string to object
        $json = json_decode($response);

        curl_close($curlObj);

        return $json->id;
    }


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
 
    $messageText =  "Message from $name via ThankYouBack: \"$message\"";
    if (strlen($voxMessageId) && strlen($voxUrl)) {
        $messageText .= " Hear their message: " . shortenUrl($voxUrl);
    }

    $sms = $client->account->messages->sendMessage(
        "646-374-2529", 
        $gifterPhone,
       ,
        array($voxUrl)
    );
    echo '{"sucess":"true"}';
?>

    