<head>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>JavaScript form validation - checking all letters</title>

<style type="text/css">
    
li {list-style-type: none;
font-size: 16pt;
}
.mail {
margin: auto;
padding-top: 10px;
padding-bottom: 10px;
width: 400px;
background : #D8F1F8;
border: 1px soild silver;
color: #000
}
.mail h2 {
margin-left: 38px;
}
input {
font-size: 20pt;
}
input:focus, textarea:focus{
background-color: lightyellow;
}
input submit {
font-size: 12pt;
}
.rq {
color: #FF0000;
font-size: 10pt;
}


</style>
</head>
<body onload='document.form1.text1.focus()'>
<div class="mail">
<h2>Enter your Name and Submit</h2>
<form name="form1" action="#">
<ul>
<li>Code:</li>
<li><input type='text' name='text1'/></li>
<li class="rq">*Enter alphabets only.</li>
<li>&nbsp;</li>
<li><input type="submit" name="submit" value="Submit" onclick="allLetter(document.form1.text1)" /></li>
<li>&nbsp;</li>
</ul>
</form>
</div>

<style type="text/css">
    


</style>

<script type="text/javascript">
    

function allLetter(inputtxt)
      { 
      var letters = /^[A-Za-z]+$/;
      if(inputtxt.value.match(letters))
      {
      alert('Your name have accepted : you can try another');
      return true;
      }
      else
      {
      alert('Please input alphabet characters only');
      return false;
      }
      }

</script>