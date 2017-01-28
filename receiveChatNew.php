<!DOCTYPE html>
<html>
<head>
	<title></title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    #a1 {color:blue;}
    #a2 {color:red;}
  </style>
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
  //$sql="insert into chat_new (username,chat,chattime) select username,chattext,chattime from chat where not exists(select chat,chattime from chat_new)";
  //$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
  //$sql4="insert into chat_new (username,chat,chattime) select username,reply,replytime from chat where not exists(select username,chat,chattime from chat_new) and chat.reply is not null";
//  $result4=mysqli_query($conn,$sql4) or die(mysqli_error($conn));
	/*$sql2="select chattext from chat where username='".$username1."'";
		$result2=mysqli_query($conn,$sql2) or die(mysqli_error());
		 	while($row2 = mysqli_fetch_assoc($result2)) {
   			//echo "you:";
   			
   			
               echo  ' <div class="messages msg_sent" id="send1">';
                                //echo '<p id="send1"> </p>';
                  echo $row2['chattext'];
                  echo '</div>';
                        
   														}*/
   			//echo "\n";
   		//echo $chattext;
   		//$sql3="select reply from chat where username='".$username1."'";
   		//$result3=mysqli_query($conn,$sql3) or die(mysqli_error($conn));
   		//while($row3 = mysqli_fetch_assoc($result3)) {
   		//	$reply= $row3['reply'];}
   		//	echo $reply;

  $sql5="select * from chat_new where username='".$username1."' order by chattime";
  $result5=mysqli_query($conn,$sql5) or die(mysqli_error($conn));
  while($row5=mysqli_fetch_assoc($result5))
  {
    if($row5['type']=='s')
      {
         //echo'<div class="col-md-10 col-xs-10" >';
                            //echo'<div class="messages msg_sent"  >';
                                //echo "<p>"
                               echo '<p style="color:#0000ff;text-align:right;">';
                               echo $row5['chat'];
                               //echo'</span>';
                               echo "</p>";
                            //echo'</div>';
                        //echo '</div>';
      }
      else if($row5['type']=='r')
      {
       //echo'<div class="col-md-10 col-xs-10" >';
                           // echo'<div class="messages msg_receive">';

                           echo '<p style="color:#000000;text-align:left;">';
                           echo $row5['chat'];
                           echo '</p>';
                                
                           // echo '</div>';
                        //echo '</div>';

      }
  }  
}
?>
</body>
</html>