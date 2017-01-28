<?php
if(isset($_POST['genOtp']))
			{
				$string = '0123456789';
       $string_shuffled = str_shuffle($string);
       $password = substr($string_shuffled, 1, 4);
       $sql6='select mobile_no from user_id where username="'.$username1.'"';
       $result6=mysqli_query($conn,$sql6) or die(mysqli_error());
        //$mobile_no=mysqli_result($result6, 0,'mobile_no'); 
        while($row3 = mysqli_fetch_assoc($result6)) {
   $mobile_no= $row3['mobile_no'];}

require __DIR__ . '/twilio-php-master/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'ACcdfe9c74f61dc2b9608a4727b453198f';
$token = '79f4ff9220ca893e6c2942a1df3d8ecf';
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$client->messages->create(
    // the number you'd like to send the message to
    $mobile_no,
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+9286155829',
        // the body of the text message you'd like to send
        'body' => $password
    )
);



       
       $query = mysqli_query("UPDATE user_id SET otp='".$password."' WHERE username = '".$username1."' ");
       $qry_run = mysqli_query($conn,$query);

			}
      ?>