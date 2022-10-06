# laravel
- My Laravel learning notes, updated as I go along.

# Installing Laravel
## Step 1: Installing Composer
- Get Composer by visiting [getcomposer.org](https://getcomposer.org/download/)
- Install Composer




# MVC Architecture in Laravel
## Model
app → Models _Directory_

## View
resources → Views _Directory_

## Controller
app →Http →Controllers _Directory_

## Linking 
routes → web.php _File_
- to register web routes 
- in the below example _test_ is the first part (until the first stop mark) of the file name: _test.blade.php_
```php
return view('test');
```

- adding a new path
```php
Route::get('/samal', function(){
    return 'Welcome Samal';
});
```

- parameterized URL manipulation
```php
Route::get('/user/{name?}', function($name ='Virat'){
    echo "Hello ".$name;
});
```
Above example can be used to view the user's profile page without hardcoding the url routing path.

- Writing Functions in URL 
```php
Route::get('/add/{num1?}/{num2?}', function($num1 = '2', $num2 = '5'){
    echo "Result: ".($num1+$num2);
});

Route::get('/sub/{num1?}/{num2?}', function($num1 = '6', $num2 = '5'){
    echo "Result: ".($num1-$num2);
});
```

## Writing Functions in [[#Controller]]
- app→Http→Controllers→Controller.php _file_
- The functions(eg: cal) we write should be inside the Controller Class
```php
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function cal($num1, $num2){

        echo "Result: ".($num1+$num2);

    }
}
```

- In the _web.php_ file we call the function we created in the controller.
```php
use App\Http\Controllers\Controller;

Route::get('/add/{num1?}/{num2?}', [Controller::class, 'cal']);
```

## Creating a Calculator App 
- Adding a new View _cal.blade.php_ to views folder
```php
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
  <input type="submit" name="addBtn" value="+"/>
  <input type="submit" name="substractBtn" value="-"/>
  <input type="submit" name="divideBtn" value="/"/>
  <input type="submit" name="multiplicationBtn" value="*"/>
  <input type="submit" name="clearBtn" value="Clear"/>
</form>
</body>
</html>
```
- creating a new controller by copying _Controller.php_ as _Calcontroller.php_
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request; //New import for calculator

class Calcontroller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function viewcal(){
        $num1 = 0;
        $num2 = 0;
        $ans = 0;

        return view('cal') -> with('numb1',$num1) -> with('numb2',$num2) -> with('answ',$ans);

    }

    public function cal(Request $request){
        $num1 = $request->n1;
        $num2 = $request->n2;
        $ans = $num1+$num2;

        return view ('cal') -> with ('numb1',$num1) -> with ('numb2', $num2) -> with ('answ', $ans);

    }

}
```
- Adding routes to _web.php_
```php
//we call this in the browser
Route::get('/calculator',[Calcontroller::class,'viewcal']); 

//this is called by the function when we click the add button
Route::post('/Calculate',[Calcontroller::class,'cal']); 
```
 > [!INFO] Pure PHP vs Laravel variable use in HTML forms 
 > ```php
value = "<?php echo "$variable"; ?>" //Pure PHP
value = {{ $variable }} //Laravel 
- To implement the substraction, multiplication, division and other functions we change only the value of the buttons while using the same button name for all the functions. Change the _call.blade.php_ and _cal_ method of _Calcontroller_ as follows.
```php
  /*call.blade.php*/
  <input type="submit" name="calbutton" value="Add"/>
  <input type="submit" name="calbutton" value="Sub"/>
  <input type="submit" name="calbutton" value="Mul"/>
  <input type="submit" name="calbutton" value="Div"/>
  <input type="submit" name="calbutton" value="Clear"/>
```

```php
/*Calcontroller*/
public function cal(Request $request){
        $num1 = $request->n1;
        $num2 = $request->n2;
        //$ans = $num1+$num2;
        $operation = $request->calbutton;

        if($operation=="Add"){
            $ans=$num1+$num2;
        }
        elseif ($operation=="Sub"){
            $ans=$num1-$num2;
        }
        elseif ($operation=="Mul"){
            $ans=$num1*$num2;
        }
        elseif ($operation=="Div"){
            if($num2==0){
                $ans="N/A";
            }else{
                $ans=$num1/$num2;
            }
        } else{
            $num1=0;
            $num2=0;
            $ans=0;
        }

        return view ('cal') -> with ('numb1',$num1) -> with ('numb2', $num2) -> with ('answ', $ans);

    }
```

