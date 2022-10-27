<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class VehicleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

public function viewVehicle(){
    $vehiclesData=Vehicle::all();
    return view('vehiclesView')-> with('vehicles', $vehiclesData);
}



}
