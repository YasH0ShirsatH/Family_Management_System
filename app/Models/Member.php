<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'birthdate',
        'marital_status',
        'mariage_date',    
        'education',
        'photo_path',
        'status'
];
    public function head(){
        return $this->belongsTo(Head::class);
    }
}
