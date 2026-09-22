<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioPremium extends Usuario
{
    public function mostrarInfo(): void
    {
        // --- RESPUESTAS AL EJERCICIO 4 DE ALTIA (VISIBILIDAD OOP) ---
        
        // 1. $this->table 
        // -> SÍ es accesible. Al ser 'protected', la propiedad se hereda a esta clase hija.
        
        // 2. $this->claveInterna 
        // -> NO es accesible. Al ser 'private', está encapsulada estrictamente en la clase base 'Usuario'.
        
        // 3. $this->esAdmin() 
        // -> SÍ es accesible. Es un método 'protected', por lo que la clase hija tiene pleno acceso a invocarlo.
        
        // 4. $this->getNombreCompletoAttribute() 
        // -> SÍ es accesible. Al ser 'public', está disponible en las clases hijas y también si instanciamos el objeto desde fuera.
    }
}