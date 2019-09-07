<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<form action="" id="the-form">
    <p>
      E-mail
      <input name="email" data-validation="email" data-validation-help="Som help info...">
    </p>
    <p>
      URL
      <input name="url" data-validation="url">
    </p>
    <p>
      Only allows alphanumeric characters and hyphen and underscore
     Name; <input name="name" data-validation="alphanumeric" data-validation-allowing="-_">
    </p>
    <p>
      Only lowercase letters a-z (regexp)
      <input name="lname" data-validation="custom" data-validation-regexp="^([a-z]+)$">
    </p>
    <p>
      Minimum 5 chars
      <input name="..." data-validation="length" data-validation-length="min5" type="text">
    </p>
    <p>
      Maximum 5 chars
      <input name="..." data-validation="length" data-validation-length="max5">
    </p>
    <p>
      Between 3-5 chars
      <input name="..." data-validation="length" data-validation-length="3-5">
    </p>
    <p>
      What's your favorite color?
      <input name="..." data-suggestions="White, Green, Blue, Black, Brown">
    </p>
    <p>
      Validate e-mail but only if an answer is given
      <input name="..." data-validation="email" data-validation-optional="true">
      <input type="text" data-validation="number">

    </p>
  
    <p>
      <input type="submit">
    </p>
  </form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate();

  $('#my-textarea').restrictLength( $('#max-length-element') );
</script>
</body>
</html>

