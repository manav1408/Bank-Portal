function checka()
{
	var url1 = "check.php";

    // get the URL
    var http1 = new XMLHttpRequest(); 

    http1.open("POST", url1, true);
    http1.onload = function (e) {
  if (http1.readyState === 4) {
    if (http1.status === 200) {
      console.log(http1.responseText);
    } else {
      console.error(http1.statusText);
    }
  }
};
http1.onerror = function (e) {
  console.error(http1.statusText);
};
    http1.send(null);
    //document.getElementById("def").innerHTML = http1.responseText;

    // prevent form from submitting
    return false;
}

