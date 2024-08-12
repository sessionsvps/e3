<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_alumno',
        'id_grado',
        'fecha',
        'seccion',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado');
    }
}
