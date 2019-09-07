<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<form method="post" action="{{url('/formvalid')}}">
		@csrf
		<div class="form-group">
			<label for="exampleFormControlInput1">fristName</label>
			<input type="text" class="form-control" id="fname" name="fname" data-validation="length required" data-validation-length="min3" >
		</div>

		<div class="form-group">
			<label for="exampleFormControlInput1">Email address</label>
			<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email"data-validation="email required">
		</div>

		<div class="form-group">
			<label for="exampleFormControlSelect1">Mobile</label>
			<input type="text" class="form-control" id="Phone" placeholder="8057208948" name="phone" data-validation="number required" maxlength="10">

		</div>

		<div class="form-group">
			<label for="exampleFormControlTextarea1">Example textarea</label>
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="textarea" data-validation="required"></textarea>
		</div>
		<div>
      <input type="submit" value="submit">
			
		</div>
	</form>
</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>



<script>
	$.validate();
</script>
</html>