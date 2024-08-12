<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alumno')->unique();
            $table->unsignedBigInteger('id_grado');
            $table->date('fecha');
            $table->string('seccion',1);
            // FK
            $table->foreign('id_alumno')->references('id')->on('alumnos');
            $table->foreign('id_grado')->references('id')->on('grados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
