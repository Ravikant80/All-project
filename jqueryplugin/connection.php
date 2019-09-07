<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
	function chkInternetStatus() {
    if(navigator.onLine) {
        alert("Hurray! You're online!!!");
    } else {
        alert("Oops! You're offline. Please check your network connection...");
    }
}
</script>
</head>
<body>
<input type="submit" value="connection" onclick="chkInternetStatus();" >
<!-- <button onclick="chkInternetStatus();" type="submit">Check Internet Connection</button> -->

</body>
</html>>