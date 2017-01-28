<!DOCTYPE html>
<html>
<head>
	<title>change password</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>
<body style="background-color:#e6ccff">
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
		$sql1='select password from user_id where username="'.$username1.'"';
		$result=mysqli_query($conn,$sql1) or die(mysqli_error());
		//$data=mysqli_result($result, 0,'password');
		while($row0 = mysqli_fetch_assoc($result)) {
   $data= $row0['password'];}	
	}

	if(isset($_POST['pwd']))
	{
		$oldPwd=$_POST['oldPwd'];
		$newPwd=$_POST['newPwd'];
		$confirmPwd=$_POST['confirmPwd'];
		if(!strcmp($data, $oldPwd))
		{
			if(!strcmp($newPwd, $confirmPwd))
			{
				if (isset($_SESSION['$user'])) {
					$username=$_SESSION['$user'];

				$sql='update user_id set password ="'.$newPwd.'" where username="'.$username.'"';
				$retval=mysqli_query($conn,$sql);
				if(!$retval)
				{
					die('could not change Password :'.mysqli_error());
				}
				//echo "added  successfully";
				mysqli_close($conn);
				            header("location:homePage.php");
exit();
				}
			}
			else
			{
				echo "passwords do not match";
			}
		}
		else
		{
			echo "old password is not valid";
		}
	}


?>

<div id="row2">
<div class="col-sm-11"></div>
<div class="col-sm-1" ><a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a></div> 
</div>

<div id="main" style="padding-top:200px">
<form style="width:35%; margin:0 auto"  method="post" action="" onsubmit="check()">
    <div class="input-group" >
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="oldPwd" type="text" class="form-control" name="oldPwd" placeholder="Enter Old Password" style="width:400px" required >
    </div> 
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="newPwd" type="text" class="form-control" name="newPwd" placeholder="Enter New Password"  style="width:400px ; "  required>
    </div>
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="confirmPwd" type="text" class="form-control" name="confirmPwd" placeholder="Confirm New Password"  style="width:400px ; "  required>
    </div>
    <div style="width:50%; margin:0 auto; padding-top:5px; ">
    <input type="submit" class="btn btn-default" name="pwd" id="pwd" value="Change Password" >   
     <a href="homePage.php" input type="submit" class="btn btn-default" name="cancel" id="cancel" >  Cancel</a>   
    </div>
    </form>
</div>

</body>
</html>