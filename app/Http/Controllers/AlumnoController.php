<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Alumno::where('estado', true);

        if ($request->has('search')) {
            $query->where('nombres', 'like', '%' . $request->search . '%');
        }

        $alumnos = $query->paginate(5);

        return view('alumnos.index', compact('alumnos'));
    }

    public function create()
    {
        return view('alumnos.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombres' => 'required|string|max:40',
            'apellidos' => 'required|string|max:40',
            'dni' => 'required|string|size:8|unique:alumnos,dni', // Validación para el campo DNI
        ]);

        // Crear un nuevo alumno
        $alumno = new Alumno();
        $alumno->nombres = $request->input('nombres');
        $alumno->apellidos = $request->input('apellidos');
        $alumno->dni = $request->input('dni'); // Asignar el DNI
        $alumno->estado = true; // Asignar el estado como true por defecto

        // Guardar el alumno en la base de datos
        $alumno->save();

        // Redirigir a la vista de lista de alumnos con un mensaje de éxito
        return redirect()->route('alumnos.index')->with('success', 'Alumno registrado correctamente.');
    }


    public function edit(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombres' => 'required|string|max:40',
            'apellidos' => 'required|string|max:40',
            'dni' => 'required|string|size:8|unique:alumnos,dni,' . $id, // Validación para el campo DNI
        ]);

        // Buscar el alumno por ID
        $alumno = Alumno::findOrFail($id);

        // Actualizar los campos del alumno
        $alumno->nombres = $request->input('nombres');
        $alumno->apellidos = $request->input('apellidos');
        $alumno->dni = $request->input('dni'); // Actualizar el DNI

        // Guardar los cambios en la base de datos
        $alumno->save();

        // Redirigir a la vista de la lista de alumnos con un mensaje de éxito
        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
    }


    public function destroy(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->estado = '0';
        $inscripciones = Inscripcion::where('id_alumno',$id)->get();
        if ($inscripciones) {
            foreach ($inscripciones as $inscripcion) {
                $inscripcion->estado = false;  // Cambiar el estado a false (o '0' según tu lógica)
                $inscripcion->save();  // Guardar los cambios en la base de datos
            }
        }
        $alumno->save();
        return redirect()->route('alumnos.index')->with('success', 'Eliminación realizada correctamente');
    }

    public function buscarPorDni($dni)
    {
        $alumno = Alumno::where('dni',$dni)->first();

        if ($alumno) {
            return response()->json(['exists' => true, 'alumno' => $alumno]);
        } else {
            return response()->json(['exists' => false, 'message' => 'Alumno no encontrado.']);
        }
    }
}
