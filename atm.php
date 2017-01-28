<!DOCTYPE html>
<html>
<head>
	<title>atm card</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.1.1.js"
  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
  crossorigin="anonymous"></script>

<script src="request_script.js"></script>  
<script src="check_script.js"></script> 

</head>
<body>


<form name="atm" id="atm" method="post" style="width:25%; margin:0 auto; padding-top:200px" onsubmit="return request()">
	<input type="submit" name="request_atm" value="Request ATM Card" class="btn btn-default" style="background-color:#098765 ; border-color:#ffffff;" >
</form>
<form name="atm1" id="atm1" method="post" style="width:25%; margin:0 auto"  onsubmit="return checka()" >
	<input type="submit" name="check" value="Check" class="btn btn-default" style="background-color:#123456 ; border-color:#ffffff">
</form>
<p id="abc"></p>
<p id="def"></p>
</body>
</html>