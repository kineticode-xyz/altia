<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // Propiedad protegida: accesible desde esta clase y las que hereden de ella.
    protected $table = 'usuarios';
    
    // Propiedad privada: accesible ÚNICAMENTE desde esta clase exacta.
    private string $claveInterna = 'secret';

    // Método protegido: invocable por esta clase y sus clases hijas.
    protected function esAdmin(): bool
    {
        return $this->rol === 'admin';
    }

    // Método público: accesible desde cualquier lugar (clase, hijas e instancias externas).
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }
}