@extends('adminlte::page')

@section('title', 'Edición de Inscripcion')

@section('content_header')
    <div class="lg:mx-20 my-4">
        <a href="{{ route('inscripciones.index') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800">Volver</a>
    </div>
@stop

@section('content')
    <div class="lg:mx-20">
        <form action="{{ route('inscripciones.update', $inscripcion->id) }}" method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
        
            <!-- Fecha -->
            <div class="mb-4">
                <label for="fecha" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Fecha de
                    Inscripción</label>
                <input type="date" id="fecha" name="fecha"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $inscripcion->fecha }}" required />
            </div>
        
            <!-- DNI del Alumno y Botón de Buscar -->
            <div class="mb-4 flex">
                <div class="w-full">
                    <label for="dni_alumno" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">DNI del
                        Alumno</label>
                    <input type="text" id="dni_alumno" name="dni_alumno"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ingrese el DNI del Alumno" value="{{ $inscripcion->alumno->dni }}" required maxlength="8"
                        pattern="\d*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                </div>
                <div class="ml-4 mt-7">
                    <button type="button" id="buscarAlumno"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Buscar
                    </button>
                </div>
            </div>
        
            <!-- Nombre y Apellidos del Alumno -->
            <div class="mb-4">
                <label for="nombre_apellido" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Nombre y
                    Apellido del Alumno</label>
                <input type="text" id="nombre_apellido" name="nombre_apellido" readonly
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $inscripcion->alumno->nombres }} {{ $inscripcion->alumno->apellidos }}"
                    placeholder="Nombre y Apellido del Alumno" />
            </div>
        
            <!-- Select de Cursos -->
            <div class="mb-4">
                <label for="id_curso" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Curso</label>
                <select id="id_curso" name="id_curso"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                    <option value="" disabled>Seleccione un curso</option>
                    @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ $curso->id == $inscripcion->id_curso ? 'selected' : '' }}>
                        {{ $curso->descripcion }}
                    </option>
                    @endforeach
                </select>
            </div>
        
            <!-- Radio Buttons para Seleccionar Turno -->
            <div class="mb-4">
                <label class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Turno</label>
                <div class="flex items-center mb-2">
                    <input id="turnoM" type="radio" name="turno" value="M"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        {{ $inscripcion->turno == 'M' ? 'checked' : '' }}>
                    <label for="turnoM" class="ml-2 text-md font-medium text-gray-900 dark:text-gray-300">Mañana</label>
                </div>
                <div class="flex items-center">
                    <input id="turnoT" type="radio" name="turno" value="T"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        {{ $inscripcion->turno == 'T' ? 'checked' : '' }}>
                    <label for="turnoT" class="ml-2 text-md font-medium text-gray-900 dark:text-gray-300">Tarde</label>
                </div>
            </div>
        
            <!-- Botón de Enviar -->
            <button type="submit"
                class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Actualizar Inscripción
            </button>
        </form>
    </div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
@stop

@section('js')

<script>
    document.getElementById('buscarAlumno').addEventListener('click', function () {
    let dniAlumno = document.getElementById('dni_alumno').value;
    
    if (dniAlumno) {
    fetch(`/api/alumnos/${dniAlumno}`)
    .then(response => response.json())
    .then(data => {
    if (data.exists) {
    document.getElementById('nombre_apellido').value = `${data.alumno.nombres} ${data.alumno.apellidos}`;
    } else {
    alert(data.message);
    document.getElementById('nombre_apellido').value = ''; // Limpiar el campo si no se encuentra el alumno
    }
    })
    .catch(error => {
    console.error('Error:', error);
    alert('Hubo un error al buscar el alumno.');
    });
    } else {
    alert('Por favor, ingrese un DNI.');
    }
    });
</script>

@stop