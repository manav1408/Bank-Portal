<!DOCTYPE html>
<html>
<head>
	<title>deposit</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  	function newAmount() {
  		var amount=document.getElementById('amount').value;
  		var addamount=document.getElementById('add_amount').value;
  		n=(parseInt(amount)+parseInt(addamount));
  		if(addamount>0)
  			window.alert("new amount is" + n);
  	}
  </script>
  
</head>
<body style="background-color:#ddffcc">
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
		$sql1='select balance from account where username="'.$username1.'"';
		$result=mysqli_query($conn,$sql1) or die(mysqli_error());
		//$data=mysqli_result($result, 0,'balance');	
			

if(isset($_POST['deposit']))

{
	$amount=$_POST['amount'];
	$add_amount=$_POST['add_amount'];
	$newAmount=($amount)+($add_amount);

		if(isset($_SESSION['$user']) && $add_amount>0)
			{
				//echo "welcome";
				$username=$_SESSION['$user'];
				$createdate= date('Y-m-d H:i:s');

				$sql='update account set balance ="'.$newAmount.'" where username="'.$username.'"';
				$sql4="insert into transaction(sender,receiver,amount,updated_balance,time) values ('$username','$username','+$add_amount','$newAmount','$createdate')";
				$retval=mysqli_query($conn,$sql);
				$retval2=mysqli_query($conn,$sql4);
				if(!$retval || !$retval2)

				{
					die('could not add amount :'.mysqli_error($retval2));
				}
				//echo "added  successfully";
				

				mysqli_close($conn);
				            header("location:homePage.php");
exit();


			}
			/*else
			{
				echo "negative amount cannot be added";
			}*/

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
<form style="width:35%; margin:0 auto"  method="post" action="" onsubmit="newAmount()">
    <div class="input-group" >
      <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
      <input id="amount" type="text" class="form-control" name="amount" placeholder="Amount Available" style="width:400px" required value="<?php 
      while($qaz = mysqli_fetch_assoc($result)) {
   			$data= $qaz['balance'];

	echo $data;}?>" readonly>
    </div> 
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
      <input id="add_amount" type="text" class="form-control" name="add_amount" placeholder="Amount to add"  style="width:400px ; "  required>
    </div>
    <div style="width:50%; margin:0 auto; padding-top:5px; ">
    <input type="submit" class="btn btn-default" name="deposit" id="deposit" value="Deposit" >   
     <a href="homePage.php" input type="submit" class="btn btn-default" name="cancel" id="cancel" >  Cancel</a>   
    </div>
    </form>
</div>

</body>
</html>