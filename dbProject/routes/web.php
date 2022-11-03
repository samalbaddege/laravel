<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Models\Animal;
use App\Http\Controllers\AnimalColorController;
use App\Models\Animal_color;

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

Route::post('/updateanimal', [AnimalController::class,'updateanimal']);

Route::get('/deleteanimal/{animalID?}', [AnimalController::class,'deleteanimal']);


//Color Routes
Route::get('/colorIndex', [AnimalColorController::class, 'viewColorIndex']);

Route::post('/savecolor',[AnimalColorController::class,'saveAnimalcolor']);

Route::get('/updateanimalcolorpage/{animalColorID?}',[AnimalColorController::class, 'viewAnimalColorUpdate']);

Route::post('/updateanimalcolor', [AnimalColorController::class,'updateanimalcolor']);

Route::get('/deleteanimalcolor/{animalColorID?}', [AnimalColorController::class,'deleteanimalcolor']);