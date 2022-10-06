<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('/calculator',function(){
    return view('cal');
});