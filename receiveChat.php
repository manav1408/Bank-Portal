<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
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
	$sql2="select chattext from chat where username='".$username1."'";
		$result2=mysqli_query($conn,$sql2) or die(mysqli_error());
		 	while($row2 = mysqli_fetch_assoc($result2)) {
   			//echo "you:";
   			echo $row2['chattext'];
   			echo "<br />";
   			
   														}
   			//echo "\n";
   		//echo $chattext;
   		//$sql3="select reply from chat where username='".$username1."'";
   		//$result3=mysqli_query($conn,$sql3) or die(mysqli_error($conn));
   		//while($row3 = mysqli_fetch_assoc($result3)) {
   		//	$reply= $row3['reply'];}
   		//	echo $reply;
}
?>
</body>
</html>