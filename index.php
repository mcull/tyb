<?php

include "messages.php";
include "senders.php";

$senderId = base64_decode($_REQUEST['id']);
$sender = getSender($senderId);
$message = getMessage($sender['recordingId']);

$fName = $sender['firstName'];

$isSMS = $sender['sms'];
$messageLabel = ($isSMS) ? "a text or email" : "an email";

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thank You Back</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
    <link href='http://fonts.googleapis.com/css?family=Nixie+One|Unkempt|Playball' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Bilbo+Swash+Caps' rel='stylesheet' type='text/css'>
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body style="font-family:'Nixie One',sans-serif">

    <div class="row"> 
      <div class="large-2 medium-2 small-2 columns">
        <img src="img/tyb_logo.png" />
      </div>
      <div class="large-10 medium-10 small-10 columns">
        <h1 style="font-family: Bilbo Swash Caps;color:red;">Thank <?php echo $fName; ?> for your Gift!</a>
      </div>
    </div>
    <div class="row" style="font-family: Unkempt">
      <div class="large-12 columns" style="text-align:center;">
        Just by saying Thank You, <?php echo $fName; ?> will receive Money Back on his order.  
        Plus
        <?php echo $fName; ?> (and you!) will receive valuable offers from this retailer on future orders.  This is how we can offer this amazing<br>
        <b>FREE THANK YOU SERVICE!</b>
      </div>
    </div>
    <div class="row">
      <div class="large-6 medium-6 small-6 columns">
        <?php echo $fName; ?> has included a personal message for you:
      </div>
      <div class="large-6 medium-6 small-6 columns">
        <a class="round button" id="play" target="_new" href="<?php echo $message['url']; ?>">Play</a>
      </div>
    </div>
    <div class="row">
      <div class="large-6 medium-6 small-6 columns">
        Send a Thank You Message to <?php echo $fName; ?>: 
      </div>
      <div class="large-6 medium-6 small-6 columns">
        <a href="tel:5026408205" id="record" class="round button">Record</a>
        <input type="text" placeholder="Message Id" id="msgId"/>
      </div>
    </div>
    <div class="row">
      <div class="large-6 medium-6 small-6 columns">
        Or send <?php echo $fName; ?> <?php echo $messageLabel; ?><br>
        <small>(your phone number and email will not be shown)</small>
      </div>
      <div class="large-6 medium-6 small-6 columns">
        <textarea id="textMessage"></textarea>
        <input type="text" id="name"  placeholder="Your Name" />
        <input type="email" id="email" placeholder="Your Email address" />
      </div>
    </div>
    <div class="row">
      <div class="large-6 medium-6 small-6 columns">
        <input type="checkbox" />Accept <a href="#">Terms of Service</a> giving permission for this retailer to text and email you offers
      </div>
      <div class="large-6 medium-6 small-6 columns">
        <a href="javascript:void(0);" id="send" class="round button">Send</a>
      </div>
    </div>   
    
    <script src="js/vendor/jquery.js"></script>
    
    <script src="js/foundation.min.js"></script>

  
    <script src="js/app.js"></script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
      $(document).foundation();
      var senderId = <?php echo $senderId; ?>;
 
      $(document).ready(function() {
        $("#send").click(function() {
          var name = $('#name').val();
          var email = $('#email').val();
          var message = $('#textMessage').val();
          var messageId = $('#msgId').val();
		

          $.getJSON( "addRecipient.php", { sid:  senderId, name: name, email: email,mid: messageId} )
            .done(function( json ) {
            $.getJSON("sendThanks.php",{sid:senderId,name:name,email:email,voxId:messageId,message:message})
              .done(function(innerJson) {
<<<<<<< HEAD
                  window.location.replace("http://54.165.184.141/success.php");
=======
                if (innerJson.success == true) {
                  window.location.replace("http://54.165.184.141/success.php");
                }
>>>>>>> 6068b4b39429d37bfe8be9f455c2076be2754757
            })
            .fail(function( jqxhr2, textStatus2, error2 ) {
              var err2 = textStatus2 + ", " + error2;
              console.log( "Request Failed: " + err2 );
            });
          })
          .fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
          });

        });
      });


    </script>
  </body>
</html>
