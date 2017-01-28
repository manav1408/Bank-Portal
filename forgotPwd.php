<!DOCTYPE html>
<html>
<head>
	<title>forgot password</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
session_start();
$servername="localhost";
$username="root";
$password="";
//$db="bank";
$conn=mysqli_connect($servername,$username,$password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
$abc=mysqli_select_db($conn,'bank');
require 'PHPMailerAutoload.php';
 //require_once 'config.php';
 require_once 'class.phpmailer.php';
  require_once 'class.smtp.php';

if( isset($_POST['newPwd']))
{

		$username1=$_POST['username'];
		$sql1='select email_id from user_id where username="'.$username1.'"';
		$result=mysqli_query($conn,$sql1) or die(mysqli_error());
		//$to=mysqli_result($result, 0,'email_id');
    while($row5 = mysqli_fetch_assoc($result)) {
   $to= $row5['email_id'];}
		$string = '0123456789QWERTYUIOPLKJHGFDSAZXCVBNMzxcvbnmlkjhgfdsaqwertyuiop';
        $string_shuffled = str_shuffle($string);
        $new_password = substr($string_shuffled, 1, 8);
        $sql2='update user_id set password="'.$new_password.'" where username="'.$username1.'"';
        $result2=mysqli_query($conn,$sql2) or die(mysqli_error());

       
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
$mail->Subject = 'updated password';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($new_password);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";


}
}


?>
<form action="" method="post">
 	  <div class="input-group" >
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="username" type="text" class="form-control" name="username" placeholder="Enter Username" style="width:400px" required>
    </div> 
    <div>
    <input type="submit" class="btn btn-default"  value="Generate New Password" name="newPwd"> 
    </div>

</form>


</body>
</html>