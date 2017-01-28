<!DOCTYPE html>
<html>
<head>
	<title>cheque</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>
<body style="background-color:#ffd480">
<?php 
session_start();
$servername="localhost";
$username="root";
$password1="";

$conn=mysqli_connect($servername,$username,$password1);

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

 	if (isset($_POST['insert']))
 		{
 			//$username1=$_SESSION['$user'];
 			$amount=$_POST['amount_paid'];
 			$account=$_POST['account_no'];
 			$cheque_no=$_POST['cheque_no'];
 			$sql="insert into insert_cheque(username,sent_or_received,person,amount,cheque_no) values ('$username1','sent','$account','$amount','$cheque_no')";
 			$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
 			$sql2="insert into insert_cheque(username,sent_or_received,person,amount,cheque_no) values ('$username1','received','$account','$amount','$cheque_no')";
 			$result2=mysqli_query($conn,$sql2) or die(mysqli_error($conn));
 			mysqli_close($conn);
                    header("location:cheque_history.php");
exit();
 		}

 		
 }
?>
<div id="main" style="padding-top:200px">
<form style="width:35%; margin:0 auto"  method="post" action="">
    
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-gbp"></i></span>
      <input id="amount_paid" type="text" class="form-control" name="amount_paid" placeholder="Amount Paid "  style="width:400px ; " required >
    </div>
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="account_no" type="text" class="form-control" name="account_no" placeholder="Account No "  style="width:400px ; " required >
    </div>
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="cheque_no" type="text" class="form-control" name="cheque_no" placeholder="Cheque Number "  style="width:400px ; "  required >
    </div>
    
    <div style="width:50%; margin:0 auto; padding-top:5px; ">
    <input type="submit" class="btn btn-default" name="insert" id="insert" value="Save">   
     <a href="homePage.php" input type="submit" class="btn btn-default" name="cancel" id="cancel" >  Cancel</a>   
     
    </div>
    </form>
</div>
</body>
</html>