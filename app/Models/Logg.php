<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logg extends Model
{
    protected $fillable = ['head_id', 'logs'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
