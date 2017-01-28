<!DOCTYPE html>
<html>
<head>
	<title></title>
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
	$sql2="select reply from chat where username='".$username1."'";
		$result2=mysqli_query($conn,$sql2) or die(mysqli_error());
		 	while($row2 = mysqli_fetch_assoc($result2)) {
   			
   			if($row2['reply']!==NULL)
   			{
   				//echo "admin:";
   				echo'<div class="messages msg_receive">';
                                //<p id="receive"> </p>
                                echo $row2['reply'];
                            echo'</div>';
   				
   				//echo "<br />";
   			}
   														}
   			
}
?>

</body>
</html>