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
            ['nombres' => 'Juan Carlos', 'apellidos' => 'Perez Gomez', 'dni' => '12345678', 'estado' => true],
            ['nombres' => 'Maria Elena', 'apellidos' => 'Gomez Martinez', 'dni' => '23456789', 'estado' => true],
            ['nombres' => 'Carlos Alberto', 'apellidos' => 'Ramirez Lopez', 'dni' => '34567890', 'estado' => true],
            ['nombres' => 'Luisa Fernanda', 'apellidos' => 'Lopez Fernandez', 'dni' => '45678901', 'estado' => true],
            ['nombres' => 'Pedro Antonio', 'apellidos' => 'Martinez Torres', 'dni' => '56789012', 'estado' => true],
            ['nombres' => 'Ana Isabel', 'apellidos' => 'Fernandez Sanchez', 'dni' => '67890123', 'estado' => true],
            ['nombres' => 'Miguel Angel', 'apellidos' => 'Torres Diaz', 'dni' => '78901234', 'estado' => true],
            ['nombres' => 'Sofia Alejandra', 'apellidos' => 'Gonzalez Ruiz', 'dni' => '89012345', 'estado' => true],
            ['nombres' => 'Diego Armando', 'apellidos' => 'Sanchez Paredes', 'dni' => '90123456', 'estado' => true],
            ['nombres' => 'Laura Beatriz', 'apellidos' => 'Diaz Mendoza', 'dni' => '01234567', 'estado' => true],
        ]);
    }

}
