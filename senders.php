<?php
 
//DB Constants - Change to your settings
$db_host='localhost';
$db_name='tyb';
$db_user='tyb';
$db_passwd='xUyUcRa4';
 

 
function addSender($recording_id,$sms,$firstName,$lastName,$email) {
    global $db_name, $db_host,$db_user,$db_passwd;
 
    mysql_connect($db_host, $db_user, $db_passwd)
        or die('Could not connect: ' . mysql_error());
 
    mysql_select_db($db_name) or die('Could not select database');
 
    $recording_id = mysql_real_escape_string($recording_id);
    $sms = mysql_real_escape_string($sms);
    $email = mysql_real_escape_string($email);
    $firstName = mysql_real_escape_string($firstName);
    $lastName = mysql_real_escape_string($lastName);
 
    // Performing SQL query
    $query = sprintf("insert into senders ("
        . "recording_id,sms,firstName,lastName,email)"
        . " values (%d,%d,'%s','%s','%s')", $recording_id,$sms,$firstName,$lastName,$email);
 
    mysql_query($query) or die('Query failed: ' . mysql_error());
 
    $id = mysql_insert_id();
    mysql_close();
    return $id;
}
 
function getSenders(){
    global $db_name, $db_host,$db_user,$db_passwd;
 
    mysql_connect($db_host, $db_user, $db_passwd)
        or die('Could not connect: ' . mysql_error());
 
    mysql_select_db($db_name) or die('Could not select database');
 
    // Performing SQL query
    $query = "select * from senders order by create_dt";
 
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
 
    $senders = array();
    while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $senders[]=$line['id'];
    }
 
    mysql_close();
 
    return $senders;
}
 
function getSender($id){
    global $db_name, $db_host,$db_user,$db_passwd;
 
    mysql_connect($db_host, $db_user, $db_passwd)
        or die('Could not connect: ' . mysql_error());
 
    mysql_select_db($db_name) or die('Could not select database');
 
    //make sure inputs are db safe
    $id = mysql_real_escape_string($id);
 
    // Performing SQL query
    $query = sprintf("select * from senders where id=%d",$id);
 
 
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
 
    $sender = array();
    if($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $sender['id']=$line['id'];
        $sender['recordingId']=$line['recording_id'];
        $sender['sms']=$line['sms'];
        $sender['firstName']=$line['firstName'];
        $sender['lastName']=$line['lastName'];
        $sender['email']=$line['email'];
        $sender['date']=$line['create_dt'];
    }
 
    mysql_close();
 
    return $sender;
}
 
?>