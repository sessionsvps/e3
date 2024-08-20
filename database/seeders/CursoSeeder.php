<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cursos')->insert([
            ['descripcion' => 'Python'],
            ['descripcion' => 'JavaScript'],
            ['descripcion' => 'Java'],
            ['descripcion' => 'C++'],
            ['descripcion' => 'Ruby on Rails'],
        ]);
    }

}
