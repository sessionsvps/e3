<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'descripcion',
    ];

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_curso');
    }
}
