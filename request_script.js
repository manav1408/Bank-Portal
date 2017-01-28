function request()
{
   
    var url = "request.php";

    // get the URL
    var http = new XMLHttpRequest(); 
	http.open("POST", url, true);
	http.onload = function (e) {
  if (http.readyState === 4) {
    if (http.status === 200) {
      console.log(http.responseText);
    } else {
      console.error(http.statusText);
    }
  }
};
http.onerror = function (e) {
  console.error(http.statusText);
};
   	http.send(null);
    //document.getElementById("abc").innerHTML = http.responseText;

    // prevent form from submitting
    return false;
}
