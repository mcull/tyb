<?php

function vgdShorten($url,$shorturl = null)
{
    //$url - The original URL you want shortened
    //$shorturl - Your desired short URL (optional)

    //This function returns an array giving the results of your shortening
    //If successful $result["shortURL"] will give your new shortened URL
    //If unsuccessful $result["errorMessage"] will give an explanation of why
    //and $result["errorCode"] will give a code indicating the type of error

    //See http://v.gd/apishorteningreference.php#errcodes for an explanation of what the
    //error codes mean. In addition to that list this function can return an
    //error code of -1 meaning there was an internal error e.g. if it failed
    //to fetch the API page.

    $url = urlencode($url);
    $basepath = "http://v.gd/create.php?format=simple";
    //if you want to use is.gd instead, just swap the above line for the commented out one below
    //$basepath = "http://is.gd/create.php?format=simple";
    $result = array();
    $result["errorCode"] = -1;
    $result["shortURL"] = null;
    $result["errorMessage"] = null;

    //We need to set a context with ignore_errors on otherwise PHP doesn't fetch
    //page content for failure HTTP status codes (v.gd needs this to return error
    //messages when using simple format)
    $opts = array("http" => array("ignore_errors" => true));
    $context = stream_context_create($opts);

    if($shorturl)
        $path = $basepath."&shorturl=$shorturl&url=$url";
    else
        $path = $basepath."&url=$url";

    $response = @file_get_contents($path,false,$context);

    if(!isset($http_response_header))
    {
        $result["errorMessage"] = "Local error: Failed to fetch API page";
        return($result);
    }

    //Hacky way of getting the HTTP status code from the response headers
    if (!preg_match("{[0-9]{3}}",$http_response_header[0],$httpStatus))
    {
        $result["errorMessage"] = "Local error: Failed to extract HTTP status from result request";
        return($result);
    }

    $errorCode = -1;
    switch($httpStatus[0])
    {
        case 200:
            $errorCode = 0;
            break;
        case 400:
            $errorCode = 1;
            break;
        case 406:
            $errorCode = 2;
            break;
        case 502:
            $errorCode = 3;
            break;
        case 503:
            $errorCode = 4;
            break;
    }

    if($errorCode==-1)
    {
        $result["errorMessage"] = "Local error: Unexpected response code received from server";
        return($result);
    }

    $result["errorCode"] = $errorCode;
    if($errorCode==0)
        $result["shortURL"] = $response;
    else
        $result["errorMessage"] = $response;

    return($result);
}

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

	error_log($response);

        // Change the response json string to object
        $json = json_decode($response);

        curl_close($curlObj);

        return $json->id;
    }

    function startsWith($haystack, $needle) {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

?>
