<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table='vehicle';


public function vehicleColor(){
    return $this->hasOne(Vehicle_color::class,'id','color_id');
}

public function vehicleType(){
    return $this->hasOne(Vehicle_type::class,'id','type_id');
}

public function vehicleWheels(){
    return $this->hasOne(Vehicle_wheels::class,'id','wheels_id');
}

}