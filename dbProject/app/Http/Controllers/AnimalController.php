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
