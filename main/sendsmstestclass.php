<?php
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
ini_set('display_errors', 1);
include('connect.php');
require __DIR__ . '/twillio/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$date=date('Y-m-d');
//$$ection="Weekly";
$sid = 'AC113452ba4e043e9e6da9ad23748e2613';
$token = 'e8e3d4395fd9e5ac61e42aa8f5c3b63b';
$client = new Client($sid, $token);
$id=$_REQUEST['id'];
//get values to be smsed
$smsbody=mysqli_fetch_array(mysqli_query($GLOBALS['connect'], ("SELECT body FROM sms WHERE id='$id'"));
$body=$smsbody['body'];
// Use the client to do fun stuff like send text messages!
$client->messages->create(
    // the number you'd like to send the message to
    '+254728944815',
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+13159391418',
        // the body of the text message you'd like to send
        'body' => $body
    )

);


mysqli_query($GLOBALS['connect'], ("INSERT INTO smslogs(sms,tel)VALUES('$body','$tel')");
  echo "<script>location.replace('smssend.php')</script>";

?>
