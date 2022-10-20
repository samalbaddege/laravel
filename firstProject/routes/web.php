<?php

use App\Http\Controllers\Calcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Convertcontroller;

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
    // return view('welcome');
    return view('test');
});

Route::get('/samal', function(){
    return 'Welcome Samal';
});

Route::get('/user/{name?}', function($name ='Virat'){
    echo "Hello ".$name;
});

// Route::get('/add/{num1?}/{num2?}', function($num1 = '2', $num2 = '5'){
//     echo "Result: ".($num1+$num2);
// });

Route::get('/sub/{num1?}/{num2?}', function($num1 = '6', $num2 = '5'){
    echo "Result: ".($num1-$num2);
});

Route::get('/add/{num1?}/{num2?}', [Controller::class, 'cal']);

//we call this in the browser
Route::get('/calculator',[Calcontroller::class,'viewcal']); 

//this is called by the function when we click the add button
Route::post('/Calculate',[Calcontroller::class,'cal']); 

//to show the converter in the browser
//Route::get('/converter',[Convertcontroller::class,'viewconv']); 

//this is called by the function when we click the convert button
Route::post('/Convert',[Convertcontroller::class,'convert']); 

//version 2 of to show the converter in the browser
Route::get('/converter/{lenMtr?}/{answ?}/{volLtr?}/{volAnsw?}',[Convertcontroller::class,'viewconv']);