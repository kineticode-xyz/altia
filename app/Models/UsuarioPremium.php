<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioPremium extends Usuario
{
    public function mostrarInfo(): void
    {
        // --- RESPUESTAS AL EJERCICIO 4 ---
        
        // 1. $this->table 
        // -> Sí es accesible. Al ser 'protected', la propiedad se hereda a esta clase hija.
        
        // 2. $this->claveInterna 
        // -> No es accesible. Al ser 'private', está encapsulada estrictamente en la clase padre 'Usuario'.
        
        // 3. $this->esAdmin() 
        // -> Sí es accesible. Es un método 'protected', por lo que la clase hija tiene acceso a invocarla.
        
        // 4. $this->getNombreCompletoAttribute() 
        // -> Sí es accesible. Al ser 'public', está disponible en las clases hijas y también si instanciamos el objeto desde fuera.
    }
}