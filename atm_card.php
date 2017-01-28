<!DOCTYPE html>
<html>
<head>
	<title>atm</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#ffffff">
<?php 

session_start();
require 'PHPMailerAutoload.php';
 //require_once 'config.php';
 require_once 'class.phpmailer.php';
  require_once 'class.smtp.php';

$servername="localhost";
$username="root";
$password="";

$conn=mysqli_connect($servername,$username,$password);

if(!$conn)
	{
		die("connection failed:".mysqli_error());
	}

	
	//echo "connection successful";
	mysqli_select_db($conn,'bank');
if(empty($_SESSION['$user'])){header('Location:login.php');} 

if(isset($_SESSION['$user']))
{ 		
	$username1=$_SESSION['$user'];
	if(isset($_POST['request_atm']))
		{
			$sql1="insert into atm(username,atm_available,count) values('$username1',0,0)";
			$result=mysqli_query($conn,$sql1) ;
			if(!$result)
			{
				die("could not insert".mysqli_error());
			}
			/*$sql2="select email_id from user_id where  username='".$username1."'";
			$result2=mysqli_query($conn,$sql2) ;
			while($row2 = mysqli_fetch_assoc($result2)) {
   			$to= $row2['email_id'];
   		}
			date_default_timezone_set('Etc/UTC');


//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "manavmiddha@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "Doaurdo@579";
//Set who the message is to be sent from
$mail->setFrom('manavmiddha@gmail.com', 'manav middha');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($to, $username1);
//Set the subject line
$mail->Subject = 'atm request received';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('the request for new card has been received and will be processed shortly.');
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}*/

		}
if(isset($_POST['check']))
{

	
		$sql3="select atm_available from atm where username='".$username1."'";
		$result3=mysqli_query($conn,$sql3) ;
			while($row3 = mysqli_fetch_assoc($result3)) {
   			$x= $row3['atm_available'];
   			//echo $x;
   		}
   		if($x==1)
   		{

   			$sql4="select atm_number from atm where username='".$username1."'";
		$result4=mysqli_query($conn,$sql4) ;
			while($row4 = mysqli_fetch_assoc($result4)) {
   			$y= $row4['atm_number'];
   		}

   		$sql5="select email_id from user_id where  username='".$username1."'";
			$result5=mysqli_query($conn,$sql5) ;
			while($row5 = mysqli_fetch_assoc($result5)) {
   			$to1= $row5['email_id'];
   		}
   			$sql6="select email_id from user_id where  username='admin'";
			$result6=mysqli_query($conn,$sql6) ;
			while($row6 = mysqli_fetch_assoc($result6)) {
   			$admin= $row6['email_id'];
   		}


   			echo "atm card generated<br>";
   			echo "atm card number is "  ;
   			echo $y;

   			
	$sql8="update atm set count=count+1 where username='".$username1."'";
		$result8=mysqli_query($conn,$sql8) or die(mysqli_error());
		$sql9="select count from atm where username='".$username1."'";
		$result9=mysqli_query($conn,$sql9) or die(mysqli_error());
		while($row9=mysqli_fetch_assoc($result9))
		{
			$count=$row9['count'];
		}
		if($count==1)
		{
/*date_default_timezone_set('Etc/UTC');
$mail2 = new PHPMailer();

$mail2->isSMTP();

$mail2->Debugoutput = 'html';

$mail2->Host = 'smtp.gmail.com';

$mail2->Port = 587;

$mail2->SMTPSecure = 'tls';

$mail2->SMTPAuth = true;

$mail2->Username = "manavmiddha@gmail.com";

$mail2->Password = "Doaurdo@579";

$mail2->setFrom('manavmiddha@gmail.com', 'manav middha');

$mail2->addAddress($to1, $username1);
$mail2->AddCC($admin,'admin');

$mail2->Subject = 'atm card generated';

$mail2->msgHTML($y);

$mail2->AltBody = 'This is a plain-text message body';

if (!$mail2->send()) {
    echo "Mailer Error: " . $mail2->ErrorInfo;
} else {
    //echo "Message sent!";


}*/


   		}
   	}
   	else if ($x==0)
   	{
   		echo "your request is being processed";
   	}
   	else
   	{
   		echo "you have not requested for a card";
   	}
   }

}

?>

<form name="atm" id="atm" method="post" style="width:25%; margin:0 auto; padding-top:200px" action="">
	<input type="submit" name="request_atm" value="Request ATM Card" class="btn btn-default" style="background-color:#098765 ; border-color:#ffffff;" 
	<?php 
$sql7="select atm_available from atm where username='".$username1."'";
		$result7=mysqli_query($conn,$sql7) ;
			while($row7 = mysqli_fetch_assoc($result7)) {
   			$x7= $row7['atm_available'];
   			if($x7==1) {?>
   			disabled
<?php ;} }?>>
	<input type="submit" name="check" value="Check" class="btn btn-default" style="background-color:#123456 ; border-color:#ffffff">
</form>


</body>
</html>