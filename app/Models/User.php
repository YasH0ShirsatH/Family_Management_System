<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function loggs(){
        return $this->hasMany(Logg::class);
    }
}
