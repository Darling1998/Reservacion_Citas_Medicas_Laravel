<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //Relacion uno a muchos
    public function roles(){
        return $this->belongsTo('App\Models\User');
    }
}
