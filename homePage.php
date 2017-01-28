<!DOCTYPE html>
<html>
<head>
	<title>home page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="chatHome.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script  language="JavaScript" type="text/javascript" src="chatHome.js"></script>

  <script type="text/javascript">
    
    function send(){
// Create our XMLHttpRequest object
var hr = new XMLHttpRequest();
// Create some variables we need to send to our PHP file
var url = "sendChat.php";
var x=document.getElementById('message').value;
var vars = "chat1="+x;
hr.open("POST", url, true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// Access the onreadystatechange event for the XMLHttpRequest object

// Send the data to PHP now... and wait for response to update the status div
hr.send(vars); // Actually execute the request

//document.getElementById("send1").innerHTML=x;
return false;

}
</script>

<script>
function sendChat(){
  var rec=new XMLHttpRequest();
  var url1="receiveChatNew.php";
  rec.open("POST",url1,true);

  rec.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  rec.onreadystatechange = function() {
    if(rec.readyState == 4 && rec.status == 200) {
        var return_data = rec.responseText;
        document.getElementById("send1").innerHTML = return_data ;
    }
}
    rec.send(null);
return false;

}
//setInterval(function(){sendChat()}, 1000)

</script>

<script>
/*function receiveChat(){
  var rec1=new XMLHttpRequest();
  var url2="receiveChatAdminNew.php";
  rec1.open("POST",url2,true);

  rec1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  rec1.onreadystatechange = function() {
    if(rec1.readyState == 4 && rec1.status == 200) {
        var return_data1 = rec1.responseText;
        document.getElementById("receive").innerHTML = return_data1 ;
    }
}
    rec1.send(null);
return false;*/

}
//setInterval(function(){receiveChat()}, 1000)
  </script>

  
 
  <style type="text/css">
  	.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
  </style>
</head>
<body style="background-color:#e1e1d0 ; overflow-x:hidden;">
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
	//echo "welcome";
   
	
		$sql3='select last_login_time from user_id where username="'.$username1.'"';
		$result3=mysqli_query($conn,$sql3) or die(mysqli_error());
		 while($row3 = mysqli_fetch_assoc($result3)) {
   $login_time = $row3['last_login_time'];}
		$sql5='select last_logout_time from user_id where username="'.$username1.'"';
		$result5=mysqli_query($conn,$sql5) or die(mysqli_error());
		//$logout_time=mysqli_result($result5, 0,'last_logout_time');
		 while($row5 = mysqli_fetch_assoc($result5)) {
   $logout_time= $row5['last_logout_time'];}
    $sql4='select notices from notice where post_time <="'.$login_time.'" and post_time>="'.$logout_time.'"';
		$result4=mysqli_query($conn,$sql4) or die(mysqli_error());

    $sql6='update user_id set otp=NULL where username="'.$username1.'"';
    $result6=mysqli_query($conn,$sql6) or die(mysqli_error());
		
}
?>


<!--<div id="row2">
<div class="col-sm-11"></div>
<div class="col-sm-1" ><a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a></div> 
</div>

<div id="rows" style="padding-top:200px">
	<div class="col-sm-4"><a href="deposit.php"  class="btn btn-primary btn-block">Deposit</a></button></div>
	<div class="col-sm-4"><a href="withdraw.php" class="btn btn-success btn-block">Withdraw</a></button></div>
	<div class="col-sm-4"><a href="transfer.php" class="btn btn-warning btn-block">Transfer</a></button></div>
</div>
<div id='asd' style="padding-top:50px">
	<div class="col-sm-4"><a href="changePassword.php" class="btn btn-danger btn-block">Change Password</a></button></div>
	<div class="col-sm-4"><a href="history.php" class="btn btn-info btn-block">Transaction History</a></button></div>
	<div class="col-sm-4"><button id="myBtn" class="btn btn-danger btn-block">View Notices</button></div>
</div>
<div id='qwe' style="padding-top:50px">
  <div class="col-sm-4"><a href="user_profile.php" class="btn btn-info btn-block" style="border-radius:24px; background-color:#abcdef">User Profile</a></button></div>
  <div class="col-sm-4"><a href="atm.php" class="btn btn-info btn-block" style="background-color:#fedcba; border-color:#000000">Card</a></button></div>
  <div class="col-sm-4"><a href="cheque.php" class="btn btn-info btn-block" style="background-color:#000000; border-color:#000000">Insert Cheque Given</a></button></div>
</div>
<div id='njnk' style="padding-top:50px">
  <div class="col-sm-4"><a href="cheque_history.php" class="btn btn-info btn-block" style="border-radius:24px; background-color:#c1b1a1">Cheque History</a></button></div>
  <div class="col-sm-4"><a href="transaction_pwd.php" class="btn btn-info btn-block" style="border-radius:24px; background-color:#ff3161">Change Transaction Password</a></button></div>
  <div class="col-sm-4"><a href="chat.php" class="btn btn-info btn-block" style="border-radius:24px; background-color:#31ff61">Chat</a></button></div>
</div>-->

<!-- The Modal -->
<!--<div id="myModal" class="modal">

  Modal content 
  <div class="modal-content">
    <span class="close">&times;</span>
    <p><?php 
    //while($row=mysqli_fetch_assoc($result4))
		{
			//echo"<br>" ;
			//echo $row['notices'];
		}?></p>
  </div>

</div>
 <script type="text/javascript">
  	// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


  </script>



<div>
<h1 > <br>current balance : <?php 
 //while($row1 = mysqli_fetch_assoc($result)) {
   //$data = $row1['balance'];
//echo $data;}
?></h1>
</div>-->



<div class="container"  >
    <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;" >
        <div class="col-xs-12 col-md-12" >
          <div class="panel panel-default" >
                <div class="panel-heading top-bar" >
                    <div class="col-md-8 col-xs-8" >
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat</h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;" >
                        <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                    </div>
                </div>
                <div class="panel-body msg_container_base" id="send1">
                

                   <!-- <div class="row msg_container base_sent" >
                        <div class="col-md-10 col-xs-10" >
                            <div class="messages msg_sent" id="send1" >
                                <p id="send1"> </p>
                                
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                        </div>
                    </div>
                    <div class="row msg_container base_receive" >
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                        </div>
                        <div class="col-md-10 col-xs-10" >
                            <div class="messages msg_receive" id="receive">
                             <p id="receive"> </p>
                                
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input name = "message" id="message" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" id="btn-chat" onclick="send()">Send</button>
                        </span>
                    </div>
                </div>
        </div>
        </div>
    </div>
    
    
</div>


</body>
</html>