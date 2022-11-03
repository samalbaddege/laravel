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
    public $timestamps = false;
    
    use HasApiTokens, HasFactory, Notifiable;
    protected $table='animal';
    # protected $primarykey = 'columnName'; To set the primary key if the columns is other than id
    
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
