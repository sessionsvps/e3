<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'dni',
    ];

    public function matricula()
    {
        return $this->hasOne(Matricula::class, 'id_alumno');
    }

    public function inscripcion()
    {
        return $this->hasOne(Inscripcion::class, 'id_alumno');
    }
}
