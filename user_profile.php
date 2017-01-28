<!DOCTYPE html>
<html>
<head>
	<title>user profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>
<body style="background-color:#ffd9b3">
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

	if(isset($_POST['update']))

	{
		
		if(isset($_SESSION['$user']))
		{

			
			$newAddr=$_POST['address'];
			$newPhone=$_POST['phone'];
			$sql3='update user_id set address ="'.$newAddr.'" where username="'.$username1.'"';
			$retval=mysqli_query($conn,$sql3);
			$sql4='update user_id set alt_ph_no ="'.$newPhone.'" where username="'.$username1.'"';
			$query=mysqli_query($conn,$sql4);

		}
		mysqli_close($conn);
				            header("location:homePage.php");
exit();


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
<form style="width:35%; margin:0 auto"  method="post" action="" >
<div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
      <input id="account_no" type="text" class="form-control" name="account_no"   style="width:400px ; "  readonly required
     value=" <?php 
 $username1=$_SESSION['$user'];
 echo $username1;
      ?>">
    </div>
<div class="input-group" style="align:center;">

      <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
      <input id="address" type="text" class="form-control" name="address" placeholder="Address"  style="width:400px ; "  required
      value="<?php 
     $username1=$_SESSION['$user'];
		$sql1='select address from user_id where username="'.$username1.'"';
		$result=mysqli_query($conn,$sql1) or die(mysqli_error());
		 while($qaz = mysqli_fetch_assoc($result)) {
   			$data= $qaz['address'];

	}
	echo $data;?>" >
    </div>
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
      <input id="phone" type="text" class="form-control" name="phone" placeholder="Alternate Phone Number"  style="width:400px ; "  required
      value="<?php

		$sql2='select alt_ph_no from user_id where username="'.$username1.'"';
		$result2=mysqli_query($conn,$sql2) or die(mysqli_error()); 
      while($ab = mysqli_fetch_assoc($result2)) {
   			$data1= $ab['alt_ph_no'];

	}
	echo $data1;?>">
    </div>
    <div style="width:50%; margin:0 auto; padding-top:5px; ">
    <input type="submit" class="btn btn-default" name="update" id="update" value="Update" >   
     <a href="homePage.php" input type="submit" class="btn btn-default" name="cancel" id="cancel" >  Cancel</a> 
    </div>
    </form>
    </div>

</div>

</body>
</html>