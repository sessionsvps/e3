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
    ];

    public function matricula()
    {
        return $this->hasOne(Matricula::class, 'id_alumno');
    }
}
