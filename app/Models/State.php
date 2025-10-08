<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

     protected $fillable = [
            'name',
            'type',
            'level',
            'latitude',
            'longitude',
            'country_id',
            'status',
        ];



     public function cities(){
        return $this->hasMany(City::class,'state_id');
    }
}
//    ALTER TABLE cities DROP FOREIGN KEY cities_ibfk_2;
