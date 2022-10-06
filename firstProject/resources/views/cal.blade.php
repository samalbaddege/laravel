<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<form method="post" action="/Calculate" name="form1">
  {{ csrf_field() }}
  <label>number 1: </label>
  <input type ="number" name="n1" value="{{ $numb1 }}"/>
  <br>
  <br>
  <label>number 2: </label>
  <input type ="number" name="n2" value="{{ $numb2 }}"/>
  <br>
  <br>
  <label>Answer : {{ $answ }}</label>
  <br>
  <br>
  <input type="submit" name="calbutton" value="Add"/>
  <input type="submit" name="calbutton" value="Sub"/>
  <input type="submit" name="calbutton" value="Mul"/>
  <input type="submit" name="calbutton" value="Div"/>
  <input type="submit" name="calbutton" value="Clear"/>
</form>
</body>
</html>
