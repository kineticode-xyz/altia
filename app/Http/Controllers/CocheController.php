<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\View\View;

/*RESPUESTAS AL EJERCICIO 3 (PROBLEMA N+1)
 *
 * 1. Problema de rendimiento con 10.000 coches:
 *    Coche::all() lanza 1 consulta para traer los 10.000 coches. Como la relación
 *    `propietario` no se carga junto a la consulta principal, cada vez que dentro
 *    del foreach se accede a $coche->propietario, Eloquent hace una consulta
 *    adicional a la base de datos para ese coche en concreto (lazy loading).
 *    Resultado: 1 consulta inicial + 10.000 consultas adicionales = 10.001
 *    consultas SQL para una sola petición HTTP. Esto es el problema N+1: el
 *    tiempo de respuesta y la carga sobre la base de datos crecen linealmente
 *    con el número de registros, en vez de mantenerse constantes.
 *
 * 2. Solución con Eloquent:
 *    Usar eager loading con with('propietario'), como se hace en el método
 *    index() de abajo. Así Eloquent lanza solo 2 consultas en total (una para
 *    los coches y una para todos los propietarios relacionados, mediante un
 *    WHERE IN), sin importar cuántos coches haya.
 *
 * 3. Si Coche no tuviera definida la relación propietario():
 *    Eloquent no reconocería 'propietario' como relación (no existe el método)
 *    ni como columna/atributo del modelo. En ese caso $coche->propietario no
 *    lanza ninguna excepción: simplemente devuelve null. El problema aparece
 *    en la siguiente instrucción, $coche->propietario->nombre, ya que se
 *    intenta leer la propiedad 'nombre' sobre null, lo que en PHP 8+ genera
 *    un warning ("Attempt to read property 'nombre' on null") y la expresión
 *    se evalúa como null, sin detener la ejecución del script.
 */

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