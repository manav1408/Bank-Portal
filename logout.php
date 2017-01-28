<!DOCTYPE html>
<html>
<head>
	<title>logout</title>
</head>
<body>
<?php 

session_start();
//if(empty($_SESSION['$user'])){header('Location:login.php');} 
$servername="localhost";
$username="root";
$password="";

$conn=mysqli_connect($servername,$username,$password);

if(!$conn)
	{
		die("connection failed:".mysqli_error());
	}
 $username1=$_SESSION['$user'];
	
	//echo "connection successful";
	mysqli_select_db($conn,'bank');
	$sql6='update user_id set last_logout_time=now() where username="'.$username1.'" ';
		$result6=mysqli_query($conn,$sql6) or die(mysqli_error());
		$sql7='update user_id set otp=NULL where username="'.$username1.'"';
		$result7=mysqli_query($conn,$sql7) or die(mysqli_error($conn));
	
		session_destroy();
		header("Location:login.php");

	
?>
</body>
</html>