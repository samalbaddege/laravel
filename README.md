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

## Writing Functions in Controller
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
 > Pure PHP vs Laravel variable use in HTML forms 
 > ```php
 > value = "<?php echo "$variable"; ?>" //Pure PHP
 > value = {{ $variable }} //Laravel
 > ``` 
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
---
# Day 2

# Further Clarification on Last week's lecture
- we create the routes/paths of the app in the web.php file.
- we should import the relevant controller (e.g. CalController) to the web.php file
- then write the route we desire in that
- with notation is described below
```php
with('variable',value)
with ('lenMtr',$lenInMtrs)
```
-  the variable should be the same as the value of the HTML field
```html
<input type ="number" name="nameLenInMtr" value="{{ $lenMtr }}"/>
```
- value is whatever we set the value to be in the controller, which could be a variable (e.g. `$lenInMtrs`) or a value like 5 or 'hello'.
- breakdown of the calling of the view in the controller
```php
return view ('bladeFileNameWithoutExtension') -> with ('variable',value);
return view ('converter') -> with ('lenMtr',$lenInMtrs);
```
- in the blade (view) file form's action should match a route in the web.php
- _converter.blade.php_
```html
<form method="post" action="/Convert" name="form1">
```
- _web.php_
```php
Route::post('/Convert',[Convertcontroller::class,'convert']);
```
---
# Using redirect to avoid URL change when submitting a form

- When we click the convert button the URL changes from `/converter` to `/Convert`. To avoid that do the following,
1. _web.php_ file 
	Changing the route to allow passing the variables in URL
```php
//version 2 of to show the converter in the browser
/*comment out the earlier version and add this instead*/
Route::get('/converter/{lenMtr?}/{answ?}/{volLtr?}/{volAnsw?}',[Convertcontroller::class,'viewconv']);
```
2. _Convertcontroller -> viewconv_ method
	Changing the view method to accept the values passed in by the URL and setting the default values in case there are no values returned. 
```php
public function viewconv( $lenInMtr = 0, $ans = 0,$volInLtr = 0,$volAnsw = 0){
//Important! : comment out the variable initial value setting inside the method
```
3. _Convertcontroller -> convert_ method
	Changing the convert method to return the answer by passing the values in the URL after converting.
```php
public function convert(Request $request){

//version 2 of returning the view
/*instead of returning a 'view' we return a 'redirect'*/
return redirect("/converter/$lenInMtrs/$ans/$volInLtrs/$volAns");
```
---
# Database
- Open Xampp
- Goto _phpmyadmin_
- Create a new database called 'animaldb'

![Pasted image 20221020112242](https://user-images.githubusercontent.com/111477436/196962301-ecdecd43-5df1-4713-9a90-68873814f2d5.png)
## Create tables
### animal _Table_
#### Fields
- id {pk}
- name
- type_id {fk}
- color_id {fk}
- legs_id {fk}
```sql
CREATE TABLE `animaldb`.`animal` (
`id` INT NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(100) NOT NULL , 
`type_id` INT(4) NOT NULL , 
`color_id` INT(4) NOT NULL , 
`legs_id` INT(4) NOT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;
```

### animal_type *Table*
#### Fields
- id {pk}
- name
```sql
CREATE TABLE `animaldb`.`animal_type` (
`id` INT NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(100) NOT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;
```
#### Data
```sql
INSERT INTO `animal_type` (`name`) VALUES ('Mammal'), ('Reptile'), ('Bird'), ('Fish');
```
### animal_color *Table*
#### Fields
- id {pk}
- name
```SQL
CREATE TABLE `animaldb`.`animal_color` (
`id` INT NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(100) NOT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;
```
#### Data
```sql
INSERT INTO `animal_color` (`name`) VALUES ('Red'), ('Brown'), ('Blue'), ('Green');
```
### no_legs  *Table*
#### Fields
- id {pk}
- name
```SQL
CREATE TABLE `animaldb`.`no_legs` (
`id` INT NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(100) NOT NULL , 
PRIMARY KEY (`id`)) ENGINE = InnoDB;
```
#### Data
```sql
INSERT INTO `no_legs` (`name`) VALUES ('One'), ('Two'), ('Three'), ('Four');
```

## Add Relationships
- Go to _animal_ table and go to _Structure_ Tab
- Click more on *type_id, color_id, legs_id* fields and click on _index_, this must be done for all three fields.

![Pasted image 20221020115237](https://user-images.githubusercontent.com/111477436/196962662-1e85435e-ac14-463e-b8a0-a51f48f64f78.png)
- Go to _Relation_ View and create the foreign key relations as follows,

![Pasted image 20221020115747](https://user-images.githubusercontent.com/111477436/196963035-0512b1cf-ba25-4ce5-93e1-46cc460e0a9a.png)
- SQL script
```sql
ALTER TABLE `animal` ADD CONSTRAINT `animal_tbl_fk1` FOREIGN KEY (`color_id`) REFERENCES `animal_color`(`id`) ON DELETE CASCADE ON UPDATE CASCADE; 
ALTER TABLE `animal` ADD CONSTRAINT `animal_tbl_fk2` FOREIGN KEY (`legs_id`) REFERENCES `no_legs`(`id`) ON DELETE CASCADE ON UPDATE CASCADE; 
ALTER TABLE `animal` ADD CONSTRAINT `animal_tbl_fk3` FOREIGN KEY (`type_id`) REFERENCES `animal_type`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
```
- If you create the relations correctly the insert should show the fields in a dropdown for all three fields *type_id, color_id, legs_id*

![Pasted image 20221020120148](https://user-images.githubusercontent.com/111477436/196963158-de85ca9d-2cf9-486d-b6e2-15e2e085106f.png)

## Adding Data to animals Table
```sql
INSERT INTO `animal` (`id`, `name`, `type_id`, `color_id`, `legs_id`) VALUES (NULL, 'Parrot', '3', '1', '2');
INSERT INTO `animal` (`id`, `name`, `type_id`, `color_id`, `legs_id`) VALUES (NULL, 'Eagle', '3', '1', '2');
INSERT INTO `animal` (`id`, `name`, `type_id`, `color_id`, `legs_id`) VALUES (NULL, 'Dog', '1', '2', '4');
INSERT INTO `animal` (`id`, `name`, `type_id`, `color_id`, `legs_id`) VALUES (NULL, 'Cat', '1', '2', '4');
INSERT INTO `animal` (`id`, `name`, `type_id`, `color_id`, `legs_id`) VALUES (NULL, 'Crocodile', '2', '2', '4');
```

## Create a new laravel project
- go to your project folder
- shift + right click and click "Open Powershell window here"
- in powershell type (where _dbProject_ is the name of the project you want to create)
```powershell
composer create-project laravel/laravel dbProject
```

![Pasted image 20221020123153](https://user-images.githubusercontent.com/111477436/196963280-bfdf2a22-583e-4506-aa20-38c10debd9d7.png)
- After project creation completes open the project folder _dbProject_ in VSCode
- There's a ".env" file in the project root, open it.
- From line 14 onwards fill the database details as necessary and save.
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=animaldb
DB_USERNAME=root
DB_PASSWORD=
```

### Creating Models
- In _app → Models_ folder there's a sample model called _User.php_, make four copies of it.
- Name those files with the names of tables, making first letter capital. (e.g. Animal, Animal_color, etc.)
- Remove the unnecessary code from the Model file, and change the class declaration to match the name of the file.
- The finished file should look like this,
```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Animal extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;   
}
```
- Add the table name to the Model file with the following code so that they can be linked,
```php
class Animal extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='animal';
}
```
- Do the above for all four files accordingly.

#### Creating the relationships
- To replicate the relationships in the _animal_ table inside the _Animal_ Model, add the following import after the existing imports in the file,
```php
use Illuminate\Database\Eloquent\Model;
```
- Create a new function _animalColor_ to get the color from the *animal_color* table. Here **id** is the *primary_key* of the *animal_color* table and **color_id** is the matching column in the _animal_ table.
```php
    public function animalColor(){
        return $this->hasOne(Animal_color::class,'id','color_id');
    }
```
- Do the same for all the other relationships
```php
    public function animalType(){
        return $this->hasOne(Animal_type::class,'id','type_id');
    }

    public function animalLegs(){
        return $this->hasOne(No_legs::class,'id','legs_id');
    }
```
- Your completed _Animal_ Model should look like this,
```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//new import
use Illuminate\Database\Eloquent\Model;

class Animal extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='animal';
    
    public function animalColor(){
        return $this->hasOne(Animal_color::class,'id','color_id');
    }

    public function animalType(){
        return $this->hasOne(Animal_type::class,'id','type_id');
    }

    public function animalLegs(){
        return $this->hasOne(No_legs::class,'id','legs_id');
    }
}
```

#### Creating the Controllers
- Duplicate the _Controller.php_ in *app → Http → Controllers* folder.
- Rename it as *AnimalController*
- Change the class declaration accordingly. 
```php
class AnimalController extends BaseController
```
- import *Animal* Model
```php
use App\Models\Animal;
```
- Create a new function called viewAnimal()
In the below code _Animal_ is the model, and _all()_ method gets all records from the corresponding table. Then we return the animalsView HTML file (blade file) with the animal data we got from the _all()_ function. Note that the last line is the same we used in the calculator app to show the calculator page.
```php
public function viewAnimal()
{
	$animalsData=Animal::all();
	return view ('animalsView')-> with ('animals', $animalsData);
}
```
- Your completed *AnimalController* should look like this,
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//new import
use App\Models\Animal;

class AnimalController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function viewAnimal()
    {
        $animalsData=Animal::all();
        return view ('animalsView')-> with ('animals', $animalsData);
    }
}
```

#### Creating the Views
- Duplicate the _welcome.blade.php_. in *resources → views* folder.
- Rename it as *animalsView.blade.php*
- Remove all contents in the body, so that the file looks like this,
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        
    </body>
</html>
```
- Add a foreach loop to show the records in the animal table inside the body.
```html
        @foreach($animals AS $animal)
        {{ $animal->name }}<br>
        @endforeach
```
- The finished file should look like this,
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        @foreach($animals AS $animal)
        {{ $animal->name }}<br>
        @endforeach
    </body>
</html>
```

#### Modifying the Route
- Open the _web.php_ file in *routes* folder. 
- Import the _AnimalController_
```php
use App\Http\Controllers\AnimalController;
```
- Add the route to show the animalsView page,
```php
Route::get('/animalpage', [AnimalController::class, 'viewAnimal']);
```
- Modified _web.php_ should look like this,
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/animalpage', [AnimalController::class, 'viewAnimal']);
```
- Now if you go to the `http://127.0.0.1:8000/animalpage` it should show the records of the _animals_ table.

![Pasted image 20221020151852](https://user-images.githubusercontent.com/111477436/196963528-0ede2550-50bf-4d18-bd50-9d6898c06a23.png)
- Now create the following sentence using all the relationships we created in _Animal_ Model.
"The _AnimalType_ _AnimalName_ which is _AnimalColor_ has _AnimalLegs_ legs."
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        @foreach($animals AS $animal)
        The {{ $animal->animalType->name }} 
        {{$animal->name}} which is 
        {{$animal->animalColor->name}} has 
        {{$animal->animalLegs->name}} legs. <br><br>
        @endforeach

    </body>
</html>
```
- Output:

![Pasted image 20221020155342](https://user-images.githubusercontent.com/111477436/196963627-1724360b-03ba-46e6-a755-216d4ea2d160.png)
- The above is only possible because we created the relationships in the _Animal_ model.

# Day 3
---
- We are going to continue with animalsdb for ease of following along.

# Insert

- create a new view in _resources → views_ as animalsInsert.blade.php
- Add a new form as,
```html
<form name="new_animal_form" method="post" action="/saveanimal">
{{ csrf_field() }}
</form>        
```
- create a table with four rows and three columns inside the form.
```html
<table border="1" align="center">
	<caption>Add New Animal</caption>
	<tbody>
	  <tr>
	    <td>Name</td>
	    <td>:</td>
	    <td></td>
	  </tr>
	  <tr>
	    <td>Type</td>
	    <td>:</td>
	    <td></td>
	  </tr>
	  <tr>
	    <td>Color</td>
	    <td>:</td>
	    <td></td>
	  </tr>
	  <tr>
	    <td># of Legs</td>
	    <td>:</td>
	    <td></td>
	  </tr>
	</tbody>
</table>
```

- To set the border of the table we just added, remove the following section from the `<head></head>` section of the file. Otherwise setting the border of the table won't work.
```html
<!-- Styles --> 
<style>
...
</style>
```
- Add a text box for the `Name` element.
```html
<td><input type="text" id= "animalName" name="animalName" placeholder="Enter Animal Name"></td>
```
- Add a select element for `Type`,`Color`,`# of Legs` `<td></td>` elements.
```html
<td><select name="selectType" id="selectType"></select></td>
<td><select name="selectColor" id="selectColor"></select></td>
<td><select name="selectLegs" id="selectLegs"></select></td>
```
- Add a new row to the table after the last row `# of Legs`to show the _Reset_ and _Submit_ buttons.
```html
<tr>
	<th scope="row" colspan="3">
		<input value="Reset" type="reset">&nbsp;
		<input value="Save" type="submit">
	</th>
</tr>
```
- Your final _animalsInsert.blade.php_ file should look like this,
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
    <form name="new_animal_form" method="post" action="/saveanimal">
            
            {{ csrf_field() }}
                        
            <table border="1" align="center">
            <caption>Add New Animal</caption>
            <tbody>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><input type="text" id= "animalName" name="animalName" placeholder="Enter Animal Name"></td>
            </tr>
            <tr>
                <td>Type</td>
                <td>:</td>
                <td><select name="selectType" id="selectType"></select></td>
            </tr>
            <tr>
                <td>Color</td>
                <td>:</td>
                <td><select name="selectColor" id="selectColor"></select></td>
            </tr>
            <tr>
                <td># of Legs</td>
                <td>:</td>
                <td><select name="selectLegs" id="selectLegs"></select></td>
            </tr>
            <tr>
                <th scope="row" colspan="3">
                    <input value="Reset" type="reset">&nbsp;
                    <input value="Save" type="submit">
                </th>
            </tr>
            </tbody>
            </table>
       </form>
    </body>
</html>
```
- Goto _AnimalController.php_ in _Http→Controllers_ and add a new method `insertAnimal()`as follows to add animal type data that needs to be shown in the dropdown of the insert form.
```php
use App\Models\Animal_type;

public function insertAnimal()
{
	$animalTypes=Animal_type::all();

return view ('animalsInsert')-> with('animalTypes', $animalTypes);
}
```
- Modify the _animalsInsert.blade.php_'s `Type` row's value `<td></td>` to view the animal type data we passed to view in the controller.
```html
<td>
	<select name="selectType" id="selectType">
		@foreach($animalTypes as $animalType)
			<option value="{{$animalType->id}}">
				{{$animalType->name}}
			</option>
		@endforeach
	</select>
</td>
```
- Now we need to do the above two steps for all the other _select_ values (dropdowns) Animal Color and Animal No of Legs.
- _AnimalController.php_ add the following code to `insertAnimal()` method.
```php
use App\Models\Animal_color;

public function insertAnimal()
    {
        $animalColors=Animal_color::all();

        return view ('animalsInsert')-> with('animalTypes', $animalTypes)->with('animalColors',$animalColors);
    }
```

```php
use App\Models\No_legs;

public function insertAnimal()
{
	$animalNoOfLegs=No_legs::all();

	return view ('animalsInsert')-> with('animalTypes', $animalTypes)->with('animalColors',$animalColors)->with('animalNoOfLegs',$animalNoOfLegs);
}
```

- To _animalsInsert.blade.php_ insert the following code.
- For Animal Color dropdown
```html
<td>
	<select name="selectColor" id="selectColor">
		@foreach($animalColors as $animalColor)
			<option value="{{$animalColor->id}}">
				{{$animalColor->name}}
			</option>
		@endforeach
	</select>
</td>
```
- For Animal No of Legs dropdown
```html
<td>
	<select name="selectLegs" id="selectLegs">
		@foreach($animalNoOfLegs as $animalNoOfLeg)
			<option value="{{$animalNoOfLeg->id}}">
				{{$animalNoOfLeg->name}}
			</option>
		@endforeach
	</select>
</td>
```
- Your completed _AnimalController.php_ should look like this,
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//new import
use App\Models\Animal;
use App\Models\Animal_color;
use App\Models\Animal_type;
use App\Models\No_legs;

class AnimalController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function viewAnimal()
    {
        $animalTypes=Animal_type::all();
        $animalColors=Animal_color::all();
        $animalNoOfLegs=No_legs::all();
        $animalsData=Animal::all();

        return view ('animalsView')-> with ('animals', $animalsData)->with('animalTypes', $animalTypes)->with('animalColors',$animalColors)->with('animalNoOfLegs',$animalNoOfLegs);
    }

    public function insertAnimal()
    {
        $animalTypes=Animal_type::all();
        $animalColors=Animal_color::all();
        $animalNoOfLegs=No_legs::all();

        return view ('animalsInsert')-> with('animalTypes', $animalTypes)->with('animalColors',$animalColors)->with('animalNoOfLegs',$animalNoOfLegs);
    }
    
}
```
- Your completed _animalsInsert.blade.php_ should look like this,
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Add Animal</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
    <form name="new_animal_form" method="post" action="/saveanimal">
		
		{{ csrf_field() }}
		
            <table border="1" align="center">
            <caption>Add New Animal</caption>
            <tbody>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><input type="text" id= "animalName" name="animalName" placeholder="Enter Animal Name"></td>
            </tr>
            <tr>
                <td>Type</td>
                <td>:</td>
                <td><select name="selectType" id="selectType">
                    @foreach($animalTypes as $animalType)
                    <option value="{{$animalType->id}}">
                    {{$animalType->name}}
                    </option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td>Color</td>
                <td>:</td>
                <td><select name="selectColor" id="selectColor">
                    @foreach($animalColors as $animalColor)
                    <option value="{{$animalColor->id}}">
                    {{$animalColor->name}}
                    </option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td># of Legs</td>
                <td>:</td>
                <td><select name="selectLegs" id="selectLegs">
                    @foreach($animalNoOfLegs as $animalNoOfLeg)
                    <option value="{{$animalNoOfLeg->id}}">
                    {{$animalNoOfLeg->name}}
                    </option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <th scope="row" colspan="3">
                    <input value="Reset" type="reset">&nbsp;
                    <input value="Save" type="submit">
                </th>
            </tr>
            </tbody>
            </table>
       </form>
    </body>
</html>
```
- Add the following code to _web.php_ so that we can navigate to the correct page when we type `/animalInsert` to the address bar,
```php
Route::get('/animalInsert', [AnimalController::class, 'insertAnimal']);
```
- Navigate to `http://127.0.0.1:8000/animalInsert`
- The page should look like this,

![Pasted image 20221028120527](https://user-images.githubusercontent.com/111477436/198843838-49c2b32c-4aa1-46e6-8169-63768e3cebc7.png)
## Save Button
- In the _AnimalController.php_ add a new method `saveAnimal()` as follows,
```php
use Illuminate\Http\Request;

public function saveAnimal(Request $request){
	$newAnimal = new Animal();
	$newAnimal->name = $request->animalName;
	$newAnimal->type_id = $request->selectType;
	$newAnimal->color_id = $request->selectColor;
	$newAnimal->legs_id = $request->selectLegs;

	$newAnimal->save();

	return redirect("/animalpage");
}
```

- ⚠ Add the following line to all Models to avoid _updated_at_ error when saving (or we need to have _updated_at_ and _inserted_at_ columns with _timestamp_ data type in the table that we are inserting data into), in this scenario we add it to _Animal_ model as the first line after class declaration,
```php
    public $timestamps = false;
```
- Add the following route to _web.php_
```php
Route::post('/saveanimal',[AnimalController::class,'saveAnimal']);
```
- If you did everything correctly up to now, a new record should be inserted into the table when you click the submit button after filling the animal details, and you'll be redirected to `http://127.0.0.1:8000/animalpage`.
- The newly inserted record will be the last one in the list. e.g. _Save Test Animal_

![Pasted image 20221028131059](https://user-images.githubusercontent.com/111477436/198843893-e38d3710-8526-43d6-a207-60fd9105beb7.png)

# Update

- This is a bit harder than what we did so far, so pay close attention to each step. 
- Make a copy of _animalsInsert.blade.php_ as _animalsUpdate.blade.php_
- Add a new hidden input next to `id=animalName` inside the `<td></td>` (which means inside the same table cell). We add this field so we can identify the id of the animal that needs to be updated. This field holds `animal` table's `id` column. We don't need to show this to the user, so we define it as a hidden field. 
```html
<input type="hidden" id= "animalID" name="animalID" value="">
```
- Take a copy of `viewAnimal()` method in _AnimalController_ and paste it at the end of the file (inside the class declaration).
- Rename the copied function as `viewAnimalUpdate()`
- Write the following code inside the method to retrieve data that's relevant to a particular animal. 
> - Note the `Animal::where('table_column','operator','$variable')` method that's used to retrive the data, compared to `Animal::all()` method which returns all the records in the table, this method only retrieves data according to the parameters `('id','=',$animalID)` we pass to it. 
> - When we return the `animalsUpdate` view (`animalsUpdate.blade.php`) we pass along data about few different things,
> - `with ('animals', $animalsData[0])` - Data about the animal that the user selected, and is probably going to be updated. _Note that we only pass the first element of the list `$animalsData`_
> - `with('animalTypes', $animalTypes)` - All the data from the _animal_type_ table. remember we got this data from `Animal_type::all()` method. This data is going to be used to fill the **selectType** dropdown, which shows all the animal types.
> - `with('animalColors',$animalColors)` - Data that's going to be used to fill the **selectColor** dropdown.
> - `with('animalNoOfLegs',$animalNoOfLegs)` - Data that's going to be used to fill the **selectLegs** dropdown.
```php
public function viewAnimalUpdate($animalID)
{
	$animalTypes=Animal_type::all();
	$animalColors=Animal_color::all();
	$animalNoOfLegs=No_legs::all();
	
	$animalsData = Animal::where('id','=',$animalID)->get();

	return view ('animalsUpdate')-> with ('animals', $animalsData[0])->with('animalTypes', $animalTypes)->with('animalColors',$animalColors)->with('animalNoOfLegs',$animalNoOfLegs);
}
```
- Modify the `id=animalName`field in _animalsUpdate.blade.php_ as follows, we remove the `placeholder=` and add `value="{{$animals->name}}"`. This is to make the field display the name of the animal that the user selected to update.
```html
<input type="text" id= "animalName" name="animalName" value="{{$animals->name}}">
```
- Setting the dropdown/select values to match that of the record's. Modify the _Type_ Dropdown as follows,
> - There are several things to unpack here, I'll go through one by one.
> - In a update scenario a dropdown should achieve two things, first it should show the value that's in the database record as _pre selected_ when the form is displayed, and it should also show all the records that the dropdown normally holds. So that the user can update that field with another value.   
> - To achieve that we add a `@if @else` condition to the dropdown code we used before. 
> - The `@if` condition checks whether `$animals->type_id` (that is the _type_id_ of the animal that we passed from the previous _animalsView.blade.php_ page) matches the `$animalType->id` (_id_ of the _animal_type_ table, data from which we used to fill the dropdown list). If they match we make that value as **selected** by using `<option selected value="{{$animalType->id}}">` and then show the corresponding _name_ of the _animal_type_ as selected value in the dropdown. The _selected value=_ is a function that can be used to pre-select a value in a dropdown when a page is loaded (a default select). 
> - In the `@else` condition we load all the other values to the dropdown, so the user can select another value if he/she chooses to do so.
```html
<td>
	<select name="selectType" id="selectType">
		@foreach($animalTypes as $animalType)
			@if($animals->type_id==$animalType->id)
				<option selected value="{{$animalType->id}}">
					{{$animalType->name}}
				</option>
			@else
				<option value="{{$animalType->id}}">
					{{$animalType->name}}
				</option>
			@endif
		@endforeach
	</select>
</td>
```
- Do the same for _Color_ and _Legs_ Dropdowns as well,
```html
<td>
	<select name="selectColor" id="selectColor">
		@foreach($animalColors as $animalColor)
			@if($animals->color_id==$animalColor->id)
				<option selected value="{{$animalColor->id}}">
					{{$animalColor->name}}
				</option>
			@else
				<option value="{{$animalColor->id}}">
					{{$animalColor->name}}
				</option>
			@endif
		@endforeach
	</select>
</td>
```
```html
<td>
	<select name="selectLegs" id="selectLegs">
		@foreach($animalNoOfLegs as $animalNoOfLeg)
			@if($animals->legs_id==$animalNoOfLeg->id)
				<option selected value="{{$animalNoOfLeg->id}}">
					{{$animalNoOfLeg->name}}
				</option>
			@else
				<option value="{{$animalNoOfLeg->id}}">
					{{$animalNoOfLeg->name}}
				</option>
			@endif
		@endforeach
	</select>
</td>
```
- Add following route to _web.php_
```php
Route::get('/updateanimalpage/{animalID?}',[AnimalController::class, 'viewanimalupdate']);
```
- Add the following code to the _animalsView.blade.php_
> Here the link `<a href="/updateanimalpage/{{$animal->id}}">Update</a>` is what takes us to the `animalsUpdate.blade.php` view. 
```html
@foreach($animals AS $animal)
The {{ $animal->animalType->name }} 
{{$animal->name}} which is 
{{$animal->animalColor->name}} has 
{{$animal->animalLegs->name}} legs.
<a href="/updateanimalpage/{{$animal->id}}">Update</a>
<br>
@endforeach
```
- The final _animalsUpdate.blade.php_ should look like this
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Update Animal</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">

    <form name="new_animal_form" method="post" action="/saveanimal">
        {{ csrf_field() }}
            <table border="1" align="center">
            <caption>Update {{$animals->name}} Record</caption>
            <tbody>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td>
                <input type="text" id= "animalName" name="animalName" value="{{$animals->name}}">
                <input type="hidden" id= "animalID" name="animalID" value="">
                </td>
            </tr>
            <tr>
                <td>Type</td>
                <td>:</td>
                <td>
                    <select name="selectType" id="selectType">
                        @foreach($animalTypes as $animalType)
                            @if($animals->type_id==$animalType->id)
                                <option selected value="{{$animalType->id}}">
                                    {{$animalType->name}}
                                </option>
                            @else
                                <option value="{{$animalType->id}}">
                                    {{$animalType->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Color</td>
                <td>:</td>
                <td>
                    <select name="selectColor" id="selectColor">
                        @foreach($animalColors as $animalColor)
                            @if($animals->color_id==$animalColor->id)
                                <option selected value="{{$animalColor->id}}">
                                    {{$animalColor->name}}
                                </option>
                            @else
                                <option value="{{$animalColor->id}}">
                                    {{$animalColor->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td># of Legs</td>
                <td>:</td>
                <td>
                    <select name="selectLegs" id="selectLegs">
                        @foreach($animalNoOfLegs as $animalNoOfLeg)
                            @if($animals->legs_id==$animalNoOfLeg->id)
                                <option selected value="{{$animalNoOfLeg->id}}">
                                    {{$animalNoOfLeg->name}}
                                </option>
                            @else
                                <option value="{{$animalNoOfLeg->id}}">
                                    {{$animalNoOfLeg->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row" colspan="3">
                    <input value="Reset" type="reset">&nbsp;
                    <input value="Save" type="submit">
                </th>
            </tr>
            </tbody>
            </table>
       </form>
    </body>
</html>

```
- And final _AnimalControlller.php_ like this,
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

//new import
use App\Models\Animal;
use App\Models\Animal_color;
use App\Models\Animal_type;
use App\Models\No_legs;

class AnimalController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function viewAnimal()
    {
        $animalTypes=Animal_type::all();
        $animalColors=Animal_color::all();
        $animalNoOfLegs=No_legs::all();
        $animalsData=Animal::all();

        return view ('animalsView')-> with ('animals', $animalsData)->with('animalTypes', $animalTypes)->with('animalColors',$animalColors)->with('animalNoOfLegs',$animalNoOfLegs);
    }

    public function insertAnimal()
    {
        $animalTypes=Animal_type::all();
        $animalColors=Animal_color::all();
        $animalNoOfLegs=No_legs::all();

        return view ('animalsInsert')-> with('animalTypes', $animalTypes)->with('animalColors',$animalColors)->with('animalNoOfLegs',$animalNoOfLegs);
    }
    
    public function saveAnimal(Request $request){
        $newAnimal = new Animal();
        $newAnimal->name = $request->animalName;
        $newAnimal->type_id = $request->selectType;
        $newAnimal->color_id = $request->selectColor;
        $newAnimal->legs_id = $request->selectLegs;

        $newAnimal->save();

        return redirect("/animalpage");

    }

    public function viewAnimalUpdate($animalID)
    {
        $animalTypes=Animal_type::all();
        $animalColors=Animal_color::all();
        $animalNoOfLegs=No_legs::all();
        
        $animalsData = Animal::where('id','=',$animalID)->get();

        return view ('animalsUpdate')-> with ('animals', $animalsData[0])->with('animalTypes', $animalTypes)->with('animalColors',$animalColors)->with('animalNoOfLegs',$animalNoOfLegs);
    }

}
```
- The _web.php_ like this,
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/animalpage', [AnimalController::class, 'viewAnimal']);

Route::get('/animalInsert', [AnimalController::class, 'insertAnimal']);

Route::post('/saveanimal',[AnimalController::class,'saveAnimal']);

Route::get('/updateanimalpage/{animalID?}',[AnimalController::class, 'viewanimalupdate']);
```
- Now we can see the following in our _animalpage_

![Pasted image 20221029221446](https://user-images.githubusercontent.com/111477436/198843951-77e89a22-2485-4229-bafa-e70754a2570c.png)
- When we click the _Update_ hyperlink we are shown the _updateanimapage_ with corresponding values for the selected animal in the corresponding fields.

![Pasted image 20221029221637](https://user-images.githubusercontent.com/111477436/198843963-55593be8-2e6d-49b8-b47d-1e09e85a8da5.png)

⚠ Note that the update functionality is not yet complete and clicking the save button in the above page will result in adding a new record to the database since we didn't write the code for updating the record yet. We only did up to taking us to the update page when the we click the hyperlink and showing the correct values in the update form fields.
