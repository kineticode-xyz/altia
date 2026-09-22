<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Documento extends Model
{
    //Tabla documentos
    protected $table = 'documentos';

    protected $fillable = ['nombre', 'csv'];

    /**
     * Genera un Código Seguro de Verificación (CSV) alfanumérico único de 12 caracteres.
     * Lanza una ValidationException si tras 100 intentos no encuentra un código libre.
     */
    public static function generarCodigoCsvUnico(): string
    {
        //Total de intentos permitidos
        $maxIntentos = 100;

        for ($i = 0; $i < $maxIntentos; $i++) {
            //Código generado
            $codigoCsv = Str::random(12);

            //Si no existe en la tabla, lo devolvemos
            if (!static::where('csv', $codigoCsv)->exists()) {
                return $codigoCsv;
            }
        }
        //Devolvemos ValidationException. Lo pide el enunciado.
        throw ValidationException::withMessages([
            'csv' => "No se pudo generar un código CSV único tras {$maxIntentos} intentos disponibles."
        ]);
    }
}