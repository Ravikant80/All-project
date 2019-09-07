<html lang="en">
<head>
<meta charset="utf-8">
<title>jquery</title>
<style type="text/css">
    label{
        display: block;
        margin-bottom: 10px;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("form").submit(function(event){
        // Stop form from submitting normally
        event.preventDefault();
        
        // Get action URL
		var actionFile = $(this).attr("action");

        /* Serialize the submitted form control values to be sent to the web server with the request */
        var formValues = $(this).serialize();
        
        // Send the form data using post
        $.post(actionFile, formValues, function(data){
            // Display the returned data in browser
            $("#result").html(data);
        });
    });
});
</script>
</head>
<body>
    <form action="display-comment.php">
        <label>Name: <input type="text" name="name"></label>
        <label>Comment: <textarea cols="50" name="comment"></textarea></label>
        <input type="submit" value="Send">
    </form>
    <div id="result"></div>
</body>
</html>                            