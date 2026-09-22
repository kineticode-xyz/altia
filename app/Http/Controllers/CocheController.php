<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\View\View;

class CocheController extends Controller
{
    //Función del ejercicio con problemas N+1
    public function indexEjercicio() {
        $coches = Coche::all();
        
        foreach ($coches as $coche) {
            $coche->propietario->nombre;
        }

        return view('coches.index', compact('coches'));
    }

    //Función correcta usando Eloquent
    public function index(): View
    {
        // La función with('propietario') es la encargada de la optimización: 
        // Resuelve el problema N+1 haciendo solo 2 consultas SQL en total, 
        // independientemente del total de coches.
        $coches = Coche::with('propietario')->get();

        return view('coches.index', compact('coches'));
    }
}