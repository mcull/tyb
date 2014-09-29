<?php
 
//DB Constants - Change to your settings
$db_host='localhost';
$db_name='tyb';
$db_user='tyb';
$db_passwd='xUyUcRa4';
 

 
function addRecipient($senderId,$name,$email,$phone) {
    global $db_name, $db_host,$db_user,$db_passwd;
 
    mysql_connect($db_host, $db_user, $db_passwd)
        or die('Could not connect: ' . mysql_error());
 
    mysql_select_db($db_name) or die('Could not select database');
 
    $senderId = mysql_real_escape_string($senderId);
    $name = mysql_real_escape_string($name);
    $email = mysql_real_escape_string($email);
    $phone = mysql_real_escape_string($phone);
 
    // Performing SQL query
    $query = sprintf("insert into recipients ("
        . "sender_id,name,email,phone)"
        . " values (%d,'%s','%s','%s')", $senderId,$name,$email,$phone);
 
    mysql_query($query) or die('Query failed: ' . mysql_error());
 
    $id = mysql_insert_id();
    mysql_close();
    return $id;
}
 
function getRecipients(){
    global $db_name, $db_host,$db_user,$db_passwd;
 
    mysql_connect($db_host, $db_user, $db_passwd)
        or die('Could not connect: ' . mysql_error());
 
    mysql_select_db($db_name) or die('Could not select database');
 
    // Performing SQL query
    $query = "select * from recipients order by create_dt";
 
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
 
    $recipients = array();
    while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $recipients[]=$line['id'];
    }
 
    mysql_close();
 
    return $recipients;
}
 
function getRecipient($id){
    global $db_name, $db_host,$db_user,$db_passwd;
 
    mysql_connect($db_host, $db_user, $db_passwd)
        or die('Could not connect: ' . mysql_error());
 
    mysql_select_db($db_name) or die('Could not select database');
 
    //make sure inputs are db safe
    $id = mysql_real_escape_string($id);
 
    // Performing SQL query
    $query = sprintf("select * from recipients where id=%d",$id);
 
 
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
 
    $recipient = array();
    if($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $recipient['id']=$line['id'];
        $recipient['sender_id']=$line['sender_id'];
        $recipient['name']=$line['name'];
        $recipient['email']=$line['email'];
        $recipient['phone']=$line['phone'];
        $recipient['date']=$line['create_dt'];
    }
 
    mysql_close();
 
    return $recipient;
}
 
?>