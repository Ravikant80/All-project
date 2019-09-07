<!DOCTYPE html>
<html>
<body>

<h1>The XMLHttpRequest Object</h1>

<p id="pid">show demo.php file contant here</p>

<button type="button" onclick="loadDoc()">Show Get</button>

<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("pid").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "demo.php", true);
  xhttp.send();
}
</script>

<br><br>
<button type="button" onclick="loadDocument()">showPost</button>


<p id="demo">post contant here........</p>
 
<script>
function loadDocument() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "demopost.php", true);
  xhttp.send();
}
</script>

</body>
</html>
