<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable=[
        'descricpion',
        'especialidad_id',
        'medico_id',
        'paciente_id',
        'fecha_cita',
        'hora_cita'
    ];
}
