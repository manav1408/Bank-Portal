<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body style="background-color:#ffffcc">
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

/*if(!$abc)
{
	echo "not Connected";
}
else if($abc)
{
	echo "Connected to db";
}*/
if(isset($_POST["login"]))
{
     
	//$username1=$_POST["username"];
	//$password1=$_POST["password"];
      
      $sql = "SELECT username FROM user_id WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'";
     if($query_run = mysqli_query($conn,$sql))
		{
			$query_num_rows = mysqli_num_rows($query_run);
			if($query_num_rows == 0)
			{
				echo "<br>Invalid Username/Password Combination";
			}
			else if($query_num_rows == 1)
			{
				while($row = mysqli_fetch_assoc($query_run)) {
   $username1 = $row['username'];
}
				$_SESSION['$user'] = $username1;
				$sql2='update user_id set last_login_time=NOW() where username="'.$username1.'" ';
		$result2=mysqli_query($conn,$sql2) or die(mysqli_error());
				//echo "login successfull";
				//echo $_SESSION['$user'];
				header("Location: homePage.php");


			}
   		}
}
   

 ?>



<div id="main" style="padding-top:200px">
<form style="width:35%; margin:0 auto;"  method="post" action="">
    <div class="input-group" >
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="username" type="text" class="form-control" name="username" placeholder="Enter Username" style="width:400px" required>
    </div> 
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password"  style="width:400px ; "  required>
    </div>
    <div style="width:50%; margin:0 auto; padding-top:5px; ">
    <input type="submit" class="btn btn-default"  value="Login" name="login"> 
     <a href="forgotPwd.php" class="btn btn-default">   Forgot Password</a>
    </div>
    </form>
</div>
</body>
</html>