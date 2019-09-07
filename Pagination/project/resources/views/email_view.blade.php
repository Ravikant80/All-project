<!DOCTYPE html>
<html>
	<head>
	<title>This is Demo Email System </title>
</head>
<body>
<br/>
<h1>Send Email</h1>

<form action="{{ url ('send/email') }}" method="post">
 			 @csrf

  <table>

	to:<input type="text" name="to"><br><br>
	message:<textarea name="message" cols="30" rows="10"></textarea><br><br>
	<input type="submit" name="submit" value="Send"><br>

</table>


</form>


</body>
</html>