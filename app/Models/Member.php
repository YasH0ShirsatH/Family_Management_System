<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function head(){
        return $this->belongsTo(Head::class);
    }
}
