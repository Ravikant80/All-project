<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("button").click(function(){
     var b = $("#test").val();
    alert("Value1: " + $("#test1").val());
    alert(b);
  });
});
</script>
</head>
<body>

<p>Name: <input type="text" id="test" value="Mickey Mouse"></p>
<p>Name: <input type="text" id="test1" value="Mickey Mousesdfsd"></p>

<button>Show Value</button>

</body>
</html>
