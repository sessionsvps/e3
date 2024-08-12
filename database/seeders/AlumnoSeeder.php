<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('alumnos')->insert([
            ['nombres' => 'Juan', 'apellidos' => 'Perez', 'estado' => true],
            ['nombres' => 'Maria', 'apellidos' => 'Gomez', 'estado' => true],
            ['nombres' => 'Carlos', 'apellidos' => 'Ramirez', 'estado' => true],
            ['nombres' => 'Luisa', 'apellidos' => 'Lopez', 'estado' => true],
            ['nombres' => 'Pedro', 'apellidos' => 'Martinez', 'estado' => true],
            ['nombres' => 'Ana', 'apellidos' => 'Fernandez', 'estado' => true],
            ['nombres' => 'Miguel', 'apellidos' => 'Torres', 'estado' => true],
            ['nombres' => 'Sofia', 'apellidos' => 'Gonzalez', 'estado' => true],
            ['nombres' => 'Diego', 'apellidos' => 'Sanchez', 'estado' => true],
            ['nombres' => 'Laura', 'apellidos' => 'Diaz', 'estado' => true],
        ]);
    }
}
