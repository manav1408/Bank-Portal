<!DOCTYPE html>
<html>
<head>
	<title>withdraw</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function check() {
		var amount=document.getElementById('amount').value;
		var withdraw_amount=document.getElementById('withdraw_amount').value;
		if((amount-withdraw_amount)<100 || withdraw_amount>100000 )
			window.alert("please withdraw less amount");
    else if(withdraw_amount<0)
      window.alert("negative amount");
		else
			window.alert("new amount is" + (amount-withdraw_amount));
	}
</script>

</head>
<body style="background-color:#ecf2f9">
<?php 
  

session_start();
$servername="localhost";
$username="root";
$password="";

$conn=mysqli_connect($servername,$username,$password);

if(!$conn)
  {
    die("connection failed:".mysqli_error($conn));
  }

  
  //echo "connection successful";
  mysqli_select_db($conn,'bank');
  if(empty($_SESSION['$user'])){header('Location:login.php');} 

  if(isset($_SESSION['$user']))
  {
    $username1=$_SESSION['$user'];
    $sql1='select balance from account where username="'.$username1.'"';
    $result=mysqli_query($conn,$sql1) or die(mysqli_error($result));
    //$data=mysqli_result($result, 0,'balance'); 

if(isset($_POST['withdraw']))

{
  $amount=$_POST['amount'];
  $withdraw_amount=$_POST['withdraw_amount'];
  $newAmount=($amount)-($withdraw_amount);
  $createdate= date('Y-m-d H:i:s');

    if(isset($_SESSION['$user']) && $newAmount>=100 && $withdraw_amount<=100000 && $withdraw_amount>=0)
      {
        //echo "welcome";
        $username=$_SESSION['$user'];

        $sql='update account set balance ="'.$newAmount.'" where username="'.$username.'"';
        $retval=mysqli_query($conn,$sql);
        $sql4="insert into transaction(sender,receiver,amount,updated_balance,time) values ('$username','$username','-$withdraw_amount','$newAmount','$createdate')";
        $retval2=mysqli_query($conn,$sql4);
        if(!$retval || !$retval2)
        {
          die('could not withdraw amount :'.mysqli_error());
        }
        //echo "withdrawed  successfully";
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
<form style="width:35%; margin:0 auto"  method="post" action="" onsubmit="check()">
    <div class="input-group" >
      <span class="input-group-addon"><i class="glyphicon glyphicon-euro"></i></span>
      <input id="amount" type="text" class="form-control" name="amount" placeholder="Amount Available" style="width:400px" required value="<?php 
      while($row = mysqli_fetch_assoc($result)) {
   $data= $row['balance'];}

  echo $data;}?>">
    </div> 
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-euro"></i></span>
      <input id="withdraw_amount" type="text" class="form-control" name="withdraw_amount" placeholder="Amount to withdraw"  style="width:400px ;"  required>
    </div>
    <div style="width:50%; margin:0 auto; padding-top:5px; ">
    <input type="submit"  value="Withdraw" class="btn btn-default" name="withdraw" id="withdraw" >  
    <a href="homePage.php" input type="submit" class="btn btn-default" name="cancel" id="cancel" >  Cancel</a>
    </div>
    </div>
    

    </form>
</div>

</body>
</html>