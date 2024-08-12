<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
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
        $request->validate([
            'nombres' => 'required|string|max:40',
            'apellidos' => 'required|string|max:40',
        ]);

        $alumno = new Alumno();
        $alumno->nombres = $request->input('nombres');
        $alumno->apellidos = $request->input('apellidos');
        $alumno->estado = true;

        $alumno->save();

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
        ]);

        // Buscar el alumno por ID
        $alumno = Alumno::findOrFail($id);

        // Actualizar los campos del alumno
        $alumno->nombres = $request->input('nombres');
        $alumno->apellidos = $request->input('apellidos');

        // Guardar los cambios en la base de datos
        $alumno->save();

        // Redirigir a la vista de la lista de alumnos con un mensaje de éxito
        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->estado = '0';
        $alumno->save();
        return redirect()->route('alumnos.index')->with('success', 'Eliminación realizada correctamente');
    }

    public function buscarPorId($id)
    {
        $alumno = Alumno::find($id);

        if ($alumno) {
            return response()->json(['exists' => true, 'alumno' => $alumno]);
        } else {
            return response()->json(['exists' => false, 'message' => 'Alumno no encontrado.']);
        }
    }
}
