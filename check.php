<!DOCTYPE html>
<html>
<head>
	<title>check</title>
</head>
<body>

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
	$db=mysqli_select_db($conn,'bank');
	if(!$db)
	{
		die("not connectd to db");

	}
	//echo "connected to db";
if(empty($_SESSION['$user'])){header('Location:login.php');}



//error_log(1)
error_reporting(E_ALL);
if(isset($_SESSION['$user']))
{ 		

	$username1=$_SESSION['$user'];

	

	
		$sql3="select atm_available from atm where username='".$username1."'";
		$result3=mysqli_query($conn,$sql3) or die(mysqli_error($conn));
			while($row3 = mysqli_fetch_assoc($result3)) {
   			$x= $row3['atm_available'];
   			echo $x;
   		}
   		if($x==1)
   		{

   			$sql4="select atm_number from atm where username='".$username1."'";
		$result4=mysqli_query($conn,$sql4) or die(mysqli_error($conn));
			while($row4 = mysqli_fetch_assoc($result4)) {
   			$y= $row4['atm_number'];
   		}

   		$sql5="select email_id from user_id where  username='".$username1."'";
			$result5=mysqli_query($conn,$sql5) or die(mysqli_error($conn));
			while($row5 = mysqli_fetch_assoc($result5)) {
   			$to1= $row5['email_id'];
   		}
   			$sql6="select email_id from user_id where  username='admin'";
			$result6=mysqli_query($conn,$sql6) or die(mysqli_error($conn));
			while($row6 = mysqli_fetch_assoc($result6)) {
   			$admin= $row6['email_id'];
   		}


   			echo "atm card generated<br>";
   			echo "atm card number is "  ;
   			echo $y;

   			
	$sql8="update atm set count=count+1 where username='".$username1."'";
		$result8=mysqli_query($conn,$sql8) or die(mysqli_error($conn));
		$sql9="select count from atm where username='".$username1."'";
		$result9=mysqli_query($conn,$sql9) or die(mysqli_error($conn));
		while($row9=mysqli_fetch_assoc($result9))
		{
			$count=$row9['count'];
		}
		if($count==1)
		{
			echo "mail has been sent";

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


?>
</body>
</html>