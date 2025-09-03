<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $fillable = ['hobby_name', 'head_id'];
    public function head(){
        return $this->belongsTo(Head::class);
    }
}
