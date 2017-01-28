<!DOCTYPE html>
<html>
<head>
	<title>chat</title>
	<script type="text/javascript">
		
		function send(){
// Create our XMLHttpRequest object
var hr = new XMLHttpRequest();
// Create some variables we need to send to our PHP file
var url = "sendChat.php";
var x=document.forms["form1"]["chat"].value;
var vars = "chat1="+x;
hr.open("POST", url, true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// Access the onreadystatechange event for the XMLHttpRequest object

// Send the data to PHP now... and wait for response to update the status div
hr.send(vars); // Actually execute the request


return false;

}
</script>
<script>
function receive(){
	var rec=new XMLHttpRequest();
	var url1="receiveChat.php";
	rec.open("POST",url1,true);

	rec.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  rec.onreadystatechange = function() {
    if(rec.readyState == 4 && rec.status == 200) {
        var return_data = rec.responseText;
        document.getElementById("send").innerHTML = return_data ;
    }
}
   	rec.send(null);
return false;

}
setInterval(function(){receive()}, 1000)
	</script>

	
</head>
<body>



<form  method="post" name="form1" id="form1" action="">
	<input type="text" name="chat" id="chat" required>
	<input type="submit" name="submit" onclick="return send()">
</form>
<p id="abc"></p>
<p id="status"></p>
</body>
</html>