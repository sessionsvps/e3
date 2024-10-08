@extends('adminlte::page')

@section('title', 'Añadir Matrícula')

@section('content_header')
    <div class="lg:mx-20 my-4">
        <a href="{{ route('alumnos.index') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800">Volver</a>
    </div>
@stop

@section('content')
    <div class="lg:mx-20">
        <form action="{{ route('matriculas.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
        
            <!-- ID del Alumno, Botón de Buscar, y Nombre y Apellidos del Alumno -->
            <div class="mb-4">
                <label for="id_alumno" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Datos del
                    Alumno</label>
                <div class="flex">
                    <input type="text" id="id_alumno" name="id_alumno"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="ID del Alumno" required />
                    <button type="button" id="buscarAlumno"
                        class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Buscar
                    </button>
                </div>
                <input type="text" id="nombre_apellido" name="nombre_apellido" readonly
                    class="mt-4 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nombre y Apellido del Alumno" />
            </div>
        
            <!-- Select de Grados y Radio Buttons para Sección -->
            <div class="mb-4">
                <label for="id_grado" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Grado y
                    Sección</label>
                <div class="flex space-x-4">
                    <select id="id_grado" name="id_grado"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                        <option value="" selected disabled>Seleccione un grado</option>
                        @foreach($grados as $grado)
                        <option value="{{ $grado->id }}">{{ $grado->descripcion }}</option>
                        @endforeach
                    </select>
        
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input id="seccionA" type="radio" name="seccion" value="A"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="seccionA" class="ml-2 text-md font-medium text-gray-900 dark:text-gray-300">A</label>
                        </div>
                        <div class="flex items-center">
                            <input id="seccionB" type="radio" name="seccion" value="B"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="seccionB" class="ml-2 text-md font-medium text-gray-900 dark:text-gray-300">B</label>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Fecha de Matrícula -->
            <div class="mb-4">
                <label for="fecha" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Fecha de
                    Matrícula</label>
                <input type="date" id="fecha" name="fecha"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
            </div>
        
            <!-- Botón de Enviar -->
            <button type="submit"
                class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Registrar Matrícula
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
    let idAlumno = document.getElementById('id_alumno').value;
    
    if (idAlumno) {
    fetch(`/api/alumnos/${idAlumno}`)
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
    alert('Por favor, ingrese un ID de alumno.');
    }
    });
</script>

@stop