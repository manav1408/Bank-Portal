<!DOCTYPE html>
<html>
<head>
	<title>cheque history</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#d1e1f1">
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
<div class="col-sm-10"></div>
<div class="col-sm-1"><a href="homePage.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-home"></span> Home
        </a></div>
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
	<th>cheque number</th>
	<th>sent or received</th>
	</tr>
	</thead>
	<?php
	if(empty($_SESSION['$user'])){header('Location:login.php');}
	$username1=$_SESSION['$user'];
	$sql='select username,cheque_no,sent_or_received,person,amount from insert_cheque where (username="'.$username1.'" and sent_or_received="sent") or (person="'.$username1.'" and sent_or_received="received")';
	$retval=mysqli_query($conn,$sql);

	if(!$retval)
				{
					die('could not get data '.mysqli_error());
				}
		while ($row=mysqli_fetch_assoc($retval)) {
					?><tbody>
					<tr>
					<td><?php echo $row['username'];	?></td>
					<td><?php echo $row['person'];	?></td>
					<td><?php echo $row['amount'];	?></td>
					<td><?php echo $row['cheque_no'];	?></td>
					<td><?php echo $row['sent_or_received'];?></td>
					</tr></tbody></div>
					<?php
				}

	/*$sql2='select username,cheque_no,sent_or_received,person,amount from insert_cheque where person="'.$username1.'"';
	$retval2=mysqli_query($conn,$sql2);

	if(!$retval2)
				{
					die('could not get data '.mysqli_error());
				}
		while ($row2=mysqli_fetch_assoc($retval2)) {
					?><tbody>
					<tr>
					<td><?php echo $row2['username'];	?></td>
					<td><?php echo $row2['person'];	?></td>
					<td><?php echo $row2['amount'];	?></td>
					<td><?php echo $row2['cheque_no'];	?></td>
					<td><?php echo $row2['sent_or_received'];?></td>
					</tr></tbody></div>
					<?php
				}
				*/


					mysqli_close($conn);
				

?>
</body>
</html>