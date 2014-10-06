<?php

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

    function startsWith($haystack, $needle) {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

?>