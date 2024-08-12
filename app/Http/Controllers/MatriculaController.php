<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Grado;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Alumno::where('estado', true)->whereHas('matricula');

        if ($request->has('search')) {
            $query->where('nombres', 'like', '%' . $request->search . '%');
        }

        $alumnos = $query->paginate(5);

        return view('matriculas.index', compact('alumnos'));
    }

    public function create()
    {
        $grados = Grado::all();
        return view('matriculas.create', compact('grados'));
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'id_alumno' => 'required|exists:alumnos,id',
            'id_grado' => 'required|exists:grados,id',
            'seccion' => 'required|in:A,B',
        ]);

        // Crear una nueva matrícula
        $matricula = new Matricula();
        $matricula->fecha = $request->input('fecha');
        $matricula->id_alumno = $request->input('id_alumno');
        $matricula->id_grado = $request->input('id_grado');
        $matricula->seccion = $request->input('seccion');

        // Guardar la matrícula en la base de datos
        $matricula->save();

        // Redirigir a la vista de lista de matrículas con un mensaje de éxito
        return redirect()->route('matriculas.index')->with('success', 'Matrícula registrada correctamente.');
    }

}
