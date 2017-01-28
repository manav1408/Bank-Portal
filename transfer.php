<!DOCTYPE html>
<html>
<head>
	<title>transfer</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
setTimeout(function() { window.location.href = "homePage.php"; }, 2* 60 * 1000);
</script>

  

</head>
<body style="background-color:#ffe6e6">

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
 $_SESSION['timeout'] = time();
  if(isset($_SESSION['$user']))
  {
    $username1=$_SESSION['$user'];
    
    $sql1='select balance from account where username="'.$username1.'"';
    $result=mysqli_query($conn,$sql1) or die(mysqli_error());
   $string = '0123456789';
       $string_shuffled = str_shuffle($string);
       $password = substr($string_shuffled, 1, 6);
   // $data=mysqli_result($result, 0,'balance'); 
    if(isset($_POST['genOtp']))
			{
				
       $sql6='select mobile_no from user_id where username="'.$username1.'"';
       $result6=mysqli_query($conn,$sql6) or die(mysqli_error());
        //$mobile_no=mysqli_result($result6, 0,'mobile_no'); 
        while($row3 = mysqli_fetch_assoc($result6)) {
   $mobile_no= $row3['mobile_no'];}

/*$post_data = array(
    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
    // For promotional, this will be ignored by the SMS gateway
    //'From'   => '8808891988',
    'To'    => $mobile_no,
    'Body'  => $password, //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
);
 
$exotel_sid = "bnbbjjb"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
$exotel_token = "1264ef60b38663104abb2444056bc225637d15d6"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
 
$url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
 
$http_result = curl_exec($ch);
$error = curl_error($ch);
$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
 
curl_close($ch);*/
 
//print "Response = ".print_r($http_result);


/*$ch=curl_init('http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey=JJFCFPiTykq6ciqKSwdrHg&senderid=zdrwlk&channel=1&DCS=0&flashsms=0&number=918368849524&text=abcd&route=1;');

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
$data = curl_exec($ch);
print($data);*/

       $query = 'update user_id set otp="'.$password.'" where username="'.$username1.'"';
       $qry_run = mysqli_query($conn,$query) or die(mysqli_error());
       $sql9='update user_id set otp_generate_time=NOW() where username="'.$username1.'" ';
    $result9=mysqli_query($conn,$sql9) or die(mysqli_error());

			}?>
<script type="text/javascript">
  function activate(){
document.getElementById('transfer').disabled=false;
  }
</script> 
   <?php
if(isset($_POST['transfer']))

{
  $amount=$_POST['amount'];
  $transfer_amount=$_POST['transfer_amount'];
  $newAmount=($amount)-($transfer_amount);
  $username2=$_POST['account_no'];
   $sql3='select balance from account where username="'.$username2.'"';
    $result2=mysqli_query($conn,$sql3);
    $username3=$_SESSION['$user'];
$enter_pwd=$_POST['otp'];
$query2='select otp from user_id where username="'.$username3.'"';
$retval5=mysqli_query($conn,$query2);
while($qaz = mysqli_fetch_assoc($retval5)) {
        $gen_otp= $qaz['otp'];}

//echo $enter_pwd;
//echo $gen_otp;

if(!strcmp($enter_pwd, $gen_otp))
{
if($username3!==$username2 )
{
    if(mysqli_num_rows($result2)==1 )
    {
    //$data2=mysqli_result($result2, 0,'balance'); 
        while($row3 = mysqli_fetch_assoc($result2)) {
   $data2= $row3['balance'];
  $x=$data2+$transfer_amount;}


   if(isset($_SESSION['$user']) && $newAmount>=100 && $transfer_amount<=100000 && $transfer_amount>=0 )
    {
        //echo "welcome";
        $username=$_SESSION['$user'];
        $createdate= date('Y-m-d H:i:s');

        $sql='update account set balance ="'.$newAmount.'" where username="'.$username.'"';
      
        $sql2='update account set balance = "'.$x.'" where username="'.$username2.'"';
        $sql4="insert into transaction(sender,receiver,amount,updated_balance,time) values ('$username','$username2','-$transfer_amount','$newAmount','$createdate')";
   
        $retval=mysqli_query($conn,$sql);
        $retval2=mysqli_query($conn,$sql2);
         $retval3=mysqli_query($conn,$sql4);
        if(!$retval || !$retval2 || !$retval3)
        	{
          		die('could not add amount :'.mysqli_error());
        	}
        	mysqli_close($conn);
                    header("location:homePage.php");
exit();
    }
         
        else
        {
        	echo("please check transfer amount");
        }
        
        //echo "withdrawed  successfully";
        
}

      
else
{
  echo "account does not exist";
}
}
else
{
  echo "change account_no";
}
}
else
{echo "otp does not match";}
}


}

?>
		
		

</script>
<div id="row2">
<div class="col-sm-11"></div>
<div class="col-sm-1" ><a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a></div> 
</div>

<div id="main" style="padding-top:200px">
<form style="width:35%; margin:0 auto"  method="post" action="" onsubmit="check()">
    <div class="input-group" >
      <span class="input-group-addon"><i class="glyphicon glyphicon-gbp"></i></span>
      <input id="amount" type="text" class="form-control" name="amount" placeholder="Amount Available" style="width:400px"  value="<?php 
while($row5 = mysqli_fetch_assoc($result)) {
   $data= $row5['balance'];}
      echo $data;?>" readonly required>
    </div> 
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-gbp"></i></span>
      <input id="transfer_amount" type="text" class="form-control" name="transfer_amount" placeholder="Amount to transfer "  style="width:400px ; "  required>
    </div>
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="account_no" type="text" class="form-control" name="account_no" placeholder="Account No "  style="width:400px ; "  required>
    </div>
    <div class="input-group" style="align:center;">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="otp" type="password" class="form-control" name="otp" placeholder="Enter OTP"  style="width:400px ; "  required>
    </div>
    <div style="width:50%; margin:0 auto; padding-top:5px; ">
    <input type="submit" class="btn btn-default" name="transfer" id="transfer" value="Transfer" disabled>   
     <a href="homePage.php" input type="submit" class="btn btn-default" name="cancel" id="cancel" >  Cancel</a>   
     
    </div>
    </form>
</div>

<form method="post" action="">
  <input type="submit" class="btn btn-default" name="genOtp" id="genOtp" value="Generate OTP" >
</form>
</body>
</html>