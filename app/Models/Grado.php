<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'descripcion',
    ];

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_grado');
    }
}
