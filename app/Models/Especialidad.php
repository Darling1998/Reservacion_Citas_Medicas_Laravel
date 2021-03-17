<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cita;
class Especialidad extends Model
{
    use HasFactory;
     protected $table ="especialidads"; 

      //$especialidades->user
     public function usuarios(){
        return $this->belongsToMany(User::class,'especialidad_user','especialidad_id')->withTimestamps();
     }
 
     public function scopeCitas(){
      return $this->hasMany(Cita::class);
  }

}
