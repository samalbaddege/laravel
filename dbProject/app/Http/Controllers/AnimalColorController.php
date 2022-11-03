<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Animal_color;
use Illuminate\Http\Request;

class AnimalColorController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function viewColorIndex()
    {
        $animalColors=Animal_color::all();

        return view ('colorIndex')->with('animalColors',$animalColors);
    }

    public function saveAnimalColor(Request $request)
    {
       $newAnimalColor = new Animal_color();
       $newAnimalColor->name = $request->animalColor;

       $newAnimalColor->save();

       return redirect("/colorIndex");
    }

    /**Taking the user to the update page*/
    public function viewAnimalColorUpdate($animalColorID)
    {           
        $animalColorData = Animal_color::where('id','=',$animalColorID)->get();

        /*This returning zero index of data is very important, otherwise it'll return an error 
        Property [name] does not exist on this collection instance.*/
        return view ('colorUpdate')->with('animalColors',$animalColorData[0]); 
    }

    public function updateAnimalColor(Request $request){
        $Animal_color = Animal_color::find($request->animalColorID);
        $Animal_color->name = $request->animalColorName;

        $Animal_color->update();

        return redirect("/colorIndex");
    }

    public function deleteAnimalColor($animalColorID){
        $Animal_color = Animal_color::find($animalColorID);
        $Animal_color->delete();
        return redirect("/colorIndex");
    }

}
