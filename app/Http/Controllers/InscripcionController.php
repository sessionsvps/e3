<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Curso;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Inscripcion::where('estado', true);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('alumno', function ($query) use ($search) {
                $query->where('nombres', 'like', '%' . $search . '%')
                    ->orWhere('apellidos', 'like', '%' . $search . '%');
            });
        }

        $inscripciones = $query->paginate(5);

        return view('inscripciones.index', compact('inscripciones'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('inscripciones.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'dni_alumno' => 'required|digits:8|exists:alumnos,dni',
            'id_curso' => 'required|exists:cursos,id',
            'turno' => 'required|in:M,T',
        ]);

        // Buscar al alumno por su DNI
        $alumno = Alumno::where('dni', $request->input('dni_alumno'))->firstOrFail();

        // Crear una nueva inscripción
        $inscripcion = new Inscripcion();
        $inscripcion->fecha = $request->input('fecha');
        $inscripcion->id_alumno = $alumno->id;
        $inscripcion->id_curso = $request->input('id_curso');
        $inscripcion->turno = $request->input('turno');
        $inscripcion->estado = true; // Establecer el estado a true por defecto

        // Guardar la inscripción en la base de datos
        $inscripcion->save();

        // Redirigir a la vista de lista de inscripciones con un mensaje de éxito
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción registrada correctamente.');
    }

    public function edit(string $id)
    {
        $cursos = Curso::all();
        $inscripcion = Inscripcion::find($id);
        return view('inscripciones.edit', compact('cursos','inscripcion'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'dni_alumno' => 'required|digits:8|exists:alumnos,dni',
            'id_curso' => 'required|exists:cursos,id',
            'turno' => 'required|in:M,T',
        ]);

        // Buscar la inscripción por su ID
        $inscripcion = Inscripcion::findOrFail($id);

        // Buscar al alumno por su DNI
        $alumno = Alumno::where('dni', $request->input('dni_alumno'))->firstOrFail();

        // Actualizar los campos de la inscripción
        $inscripcion->fecha = $request->input('fecha');
        $inscripcion->id_alumno = $alumno->id;
        $inscripcion->id_curso = $request->input('id_curso');
        $inscripcion->turno = $request->input('turno');
        $inscripcion->estado = true; // Mantener el estado como true

        // Guardar los cambios en la base de datos
        $inscripcion->save();

        // Redirigir a la vista de lista de inscripciones con un mensaje de éxito
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->estado = '0';
        $inscripcion->save();
        return redirect()->route('inscripciones.index')->with('success', 'Eliminación realizada correctamente');
    }
}
