<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Especialidad;
use App\Models\Cita;
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'apellido',
        'cedula',
        'telefono',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot',
        'created_at',
        'updated_at',
        'rol_id',
        'email_verified_at',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function especialidades(){
        return $this->belongsToMany(Especialidad::class,'especialidad_user','user_id')->withTimestamps();
    } 


    public function scopeMedicos($query)
    {
        return $query->where('role_id', '2');
    }

    public function scopePacientes($query)
    {
        return $query->where('role_id', '3');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
    * Return a key value array, containing any custom claims to be 
    * added to the JWT.
    * @return array
    */
    public function getJWTCustomClaims()
    {
        return [];
    }


    //citas atendidas filtro
    public function citasAtendidas(){
        return $this->citasPorDoctor()->where('estado','Atendida');
    }

    //citas canceladas filtro
    public function citasCanceladas()
    {
        return $this->citasPorDoctor()->where('estado','Cancelada');
    }

    //las citas de un usuario medico
    public function citasPorDoctor(){
        return $this->hasMany(Cita::class,'medico_id');
    }


    //citas de un usuario paciente

    public function citascomoPaciente(){
        return $this->hasMany(Cita::class,'paciente_id');
    }


    public function enviarFCM($mensaje){
       return fcm()
            ->to([$this->dispos_token])
            ->priority('high')
            ->timeToLive(0)
            ->data([
                'title' => 'ServiNatal',
                'body' => $mensaje,
            ])->send();
    }
}
