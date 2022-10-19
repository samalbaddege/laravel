<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Converter</title>
</head>
<body>
<form method="post" action="/Convert" name="form1">
  {{ csrf_field() }}
  <label>length in meters: </label>
  <input type ="number" name="nameLenInMtr" value="{{ $lenMtr }}"/>
  <br>
  <br>
  <label>Answer : {{ $answ }}</label>
  <br>
  <br>
  <input type="submit" name="convertButton" value="mm"/>
  <input type="submit" name="convertButton" value="cm"/>
  <input type="submit" name="convertButton" value="inch"/>
  <input type="submit" name="convertButton" value="feet"/>
  <input type="submit" name="convertButton" value="Clear"/>
  <br>
  <br>
  <label>Volume in Liters: </label>
  <input type ="number" name="nameVolInLtr" value="{{ $volLtr }}"/>
  <br>
  <br>
  <label>Answer : {{ $volAnsw }}</label>
  <br>
  <br>
  <input type="submit" name="convertButton" value="ml"/>
  <input type="submit" name="convertButton" value="fl-oz"/>
  <input type="submit" name="convertButton" value="gal"/>
  <input type="submit" name="convertButton" value="pint"/>
  <input type="submit" name="convertButton" value="Clear"/>
  
</form>
</body>
</html>
