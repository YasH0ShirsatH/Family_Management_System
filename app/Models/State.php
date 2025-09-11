<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $fillable = ['name','status'];

    

     public function cities(){
        return $this->hasMany(City::class,'state_id');
    }
}
//    ALTER TABLE your_table_name DROP FOREIGN KEY cities_ibfk_2;