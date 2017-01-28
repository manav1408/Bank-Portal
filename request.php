<!DOCTYPE html>
<html>
<head>
	<title>request</title>
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
	mysqli_select_db($conn,'bank');
if(empty($_SESSION['$user'])){header('Location:login.php');}




if(isset($_SESSION['$user']))
{ 		
	$username1=$_SESSION['$user'];
	
			$sql1="insert into atm(username,atm_available,count) values('$username1',0,0)";
			$result=mysqli_query($conn,$sql1) ;
			if(!$result)
			{
				die("could not insert".mysqli_error($conn));
				//$data="could not insert";
			}
			else{
				echo "inserted";
			}
		//echo $data;
}
mysqli_close($conn);
?>
</body>
</html>