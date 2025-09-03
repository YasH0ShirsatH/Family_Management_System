<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    public function members(){
        return $this->hasMany(Member::class);
    }
    public function hobbies(){
        return $this->hasMany(Hobby::class);
    }
}
