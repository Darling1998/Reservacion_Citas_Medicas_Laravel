<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia',
        'activo',
        'hora_inicio_mñn',
        'hora_fin_mñn',
        'hora_inicio_tarde',
        'hora_fin_tarde',
        'user_id'
    ];
    protected $table ="dia_trabajos"; 
}
