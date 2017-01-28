<!DOCTYPE html>
<html>
<head>
	<title>history</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  </script>
</head>
<body style="background-color:#ecc6c6">

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
	mysqli_select_db($conn,'bank'); ?>
	<div id="row2">
<div class="col-sm-11"></div>
<div class="col-sm-1" ><a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a></div> 
</div>
	<div>
	<table class="table table-hover">
	<thead>
	<tr>
	<th>sender</th>
	<th>receiver</th>
	<th>amount</th>
	<th>updated balance</th>
	<th>time</th>
	</tr>
	</thead>
	<?php
	if(empty($_SESSION['$user'])){header('Location:login.php');}
	$username1=$_SESSION['$user'];
	$sql='select sender,receiver,amount,updated_balance,time from transaction where sender="'.$username1.'" ';
	$retval=mysqli_query($conn,$sql);

	if(!$retval)
				{
					die('could not get data '.mysqli_error());
				}
		while ($row=mysqli_fetch_assoc($retval)) {
					?><tbody>
					<tr>
					<td><?php echo $row['sender'];	?></td>
					<td><?php echo $row['receiver'];	?></td>
					<td><?php echo $row['amount'];	?></td>
					<td><?php echo $row['updated_balance'];	?></td>
					<td><?php echo $row['time'];?></td>
					</tr></tbody></div>
					<?php
				}


					mysqli_close($conn);
				

?>
<div class="col-sm-4">
<form name="download" action="" method="post" onsubmit="">
<button class="btn btn-danger btn-block">download statement</button></form></div>
</body>
</html>