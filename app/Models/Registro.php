<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $connection = 'sqlsrv'; 
    protected $table = 'registros';

    public function scopePorIds(Builder $consulta, int|array $ids): Builder
    {
        //Obtenemos el valor del conjunto o unidad
        $idsValor = is_array($ids) ? $ids : [$ids];
        //Máximo valores permitidos para realizar el procesamiento. Podemos más pero para hacerlo seguro lo dejamos así.
        $limiteParametros = 2000; 

        if (count($idsArray) > $limiteParametros) {
            $consulta->where(function ($subConsulta) use ($idsArray, $limiteParametros) {
                foreach (array_chunk($idsArray, $limiteParametros) as $bloqueIds) {
                    $subConsulta->orWhereIn('id', $bloqueIds);
                }
            });

            return $consulta;
        }

        return $consulta->whereIn('id', $idsArray);
    }
}