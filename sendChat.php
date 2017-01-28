<?php 
session_start();
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
		$text=$_POST['chat1'];
		$sql1="insert into chat (username,chattext,chattime) values ('$username1','$text',NOW())";
		$result1=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
		
}

?>