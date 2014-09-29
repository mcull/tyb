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
      <div class="large-2 medium-2 small-4 columns">
       <img src="img/tyb_logo.png" />
      </div>
       <div class="large-10 medium-10 small-8 columns">
        <h1 style="font-family: Bilbo Swash Caps;color:red;">Add a message!</a>
      </div>
    </div>
    <div class="row">
       <hr>
      <div class="large-1 medium-1 small-1 columns">
        <h2>1</h2>
      </div>
      <div class="large-11 medium-11 small-11 columns">
        Call <a href="tel:6463742529">646.374.2529</a> to record message for recipient.
      </div>
    </div>
    <div class="row">
      <hr>
      <div class="large-1 medium-1 small-1 columns">
        <h2>2</h2>
      </div>
      <div class="large-5 medium-5 small-5 columns">
        Enter recording ID
      </div>
      <div class="large-4 medium-4 small-4 columns">
        <input type="text" name="recordingId" id="recordingId">
      </div>
      <div class="large-2 medium-2 small-2 columns">
        <button id="lookupId" class="tiny">&raquo;</button>
      </div>
    </div>
    <div class="row" id="previewRow" style="display:none" >
      <hr>
      <div class="large-1 medium-1 small-1 columns">
        <h2>3</h2>
      </div>
      <div class="large-5 medium-5 small-5 columns" id="preview">
        Listen to recording
      </div>
      <div class="large-6 medium-6 small-6 columns">
        <a href="" target="_new" id="previewAudio">Play</a>
      </div>
    </div>
    <div class="row" id="smsRow" style="display:none">
      <hr>
      <div class="large-1 medium-1 small-1 columns">
        <h2>4</h2>
      </div>
      <div class="large-5 medium-5 small-5 columns" id="smsNum">
        
      </div>
      <div class="large-6 medium-6 small-6 columns">
        <input type="checkbox" name="sms" id="sms" checked>  SMS?
      </div>
    </div>
    <div class="row" id="emailRow" style="display:none" >
      <hr>
      <div class="large-1 medium-1 small-1 columns">
        <h2>5</h2>
      </div>
      <div class="large-5 medium-5 small-5 columns">
        Enter Name
      </div>
      <div class="large-6 medium-6 small-6 columns">
        <input type="text" name="firstName" id="firstName" placeholder="first">
        <input type="text" name="lastName" id="lastName" placeholder="last">
      </div>
    </div>
    <div class="row" id="emailRow" style="display:none" >
      <hr>
      <div class="large-1 medium-1 small-1 columns">
        <h2>6</h2>
      </div>
      <div class="large-5 medium-5 small-5 columns">
        Enter email
      </div>
      <div class="large-6 medium-6 small-6 columns">
        <input type="text" name="email" id="email">
      </div>
    </div>
    <div class="row" id="QR" style="display:none" >
      <hr>
      <div class="large-1 medium-1 small-1 columns">
        <h2>7</h2>
      </div>
      <div class="large-5 medium-5 small-5 columns">
       Generate QR Code and URL
      </div>
      <div class="large-6 medium-6 small-6 columns">
        <button type="button" id="generateQR">Go</button>
      </div>
    </div>
    <div class="row" id="qr">
    </div>
    
    <script src="js/vendor/jquery.js"></script>
    
    <script src="js/foundation.min.js"></script>

  
    <script src="js/app.js"></script>

    <script>
      $(document).foundation();
 
      $(document).ready(function() {
        $("#lookupId").click(function() {
          var messageId = $("#recordingId").val();
          $.getJSON( "lookup.php", { id: messageId } )
            .done(function( json ) {
              $("#previewAudio").attr("href",json.url);
              $("#smsNum").html("Reply to number " + json.from);
              $(".row").show();
            })
            .fail(function( jqxhr, textStatus, error ) {
              var err = textStatus + ", " + error;
              console.log( "Request Failed: " + err );
          });

          
            

        });

       $("#generateQR").click(function() {
          var recordingId = $('#recordingId').val();
          var sms = $('#sms').is(':checked') ? 1 : 0;
          var email = $('#email').val();
          var fName = $('#firstName').val();
          var lName = $('#lastName').val();
          $.getJSON( "addSender.php", { rid:  recordingId, sms: sms, email: email,firstName:fName, lastName:lName} )
            .done(function( json ) {
              console.log(json);
              var url = "http://54.165.184.141?id=" + btoa(json);
              $("#qr").html("<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=" + url + "'> or go to " + url);
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
