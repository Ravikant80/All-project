<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Example of Making GET Request using Ajax in jQuery</title>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("button").click(function(){
        $.get("jget.php", function(data){
            // Display the returned data in browser
            $("#result").html(data);
        });
    });
});
</script>
</head>
<body>
    <div id="result">
        <h2>Content of the result Division box will be replaced by the server date and time</h2>
    </div>
    <button type="button">Load Date and Time</button>
</body>
</html>