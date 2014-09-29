<?php
 
//DB Constants - Change to your settings
$db_host='localhost';
$db_name='tyb';
$db_user='tyb';
$db_passwd='xUyUcRa4';
 

 
function addMessage($caller_id, $recording_url) {
    global $db_name, $db_host,$db_user,$db_passwd;
 
    mysql_connect($db_host, $db_user, $db_passwd)
        or die('Could not connect: ' . mysql_error());
 
    mysql_select_db($db_name) or die('Could not select database');
 
    $caller_id = mysql_real_escape_string($caller_id);
    $recording_url = mysql_real_escape_string($recording_url);
 
    // Performing SQL query
    $query = sprintf("insert into messages ("
        . "message_date,caller_id,audio_url)"
        . " values (now(),'%s','%s')", $caller_id,
        $recording_url);
 
    mysql_query($query) or die('Query failed: ' . mysql_error());
 
    $id = mysql_insert_id();
    mysql_close();
    return $id;
}
 
function getMessages($voicemail_exten,$flag=0){
    global $db_name, $db_host,$db_user,$db_passwd;
 
    mysql_connect($db_host, $db_user, $db_passwd)
        or die('Could not connect: ' . mysql_error());
 
    mysql_select_db($db_name) or die('Could not select database');
 
    //make sure inputs are db safe
    $voicemail_exten = mysql_real_escape_string($voicemail_exten);
    $flag = mysql_real_escape_string($flag);
 
    // Performing SQL query
    $query = "select * from messages order by message_date";
 
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
 
    $messages = array();
    while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $messages[]=$line['message_id'];
    }
 
    mysql_close();
 
    return $messages;
}
 
function getMessage($msg_id){
    global $db_name, $db_host,$db_user,$db_passwd;
 
    mysql_connect($db_host, $db_user, $db_passwd)
        or die('Could not connect: ' . mysql_error());
 
    mysql_select_db($db_name) or die('Could not select database');
 
    //make sure inputs are db safe
    $msg_id = mysql_real_escape_string($msg_id);
 
    // Performing SQL query
    $query = sprintf("select * from messages where message_id=%d",$msg_id);
 
 
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
 
    $message = array();
    if($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $message['id']=$line['id'];
        $message['date']=$line['message_date'];
        $message['from']=$line['caller_id'];
        $message['url']=$line['audio_url'];
    }
 
    mysql_close();
 
    return $message;
}
 
?>