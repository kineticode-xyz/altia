<?php

namespace Tests\Feature;

use App\Models\UsuarioPremium;
use BadMethodCallException;
use Tests\TestCase;

class VisibilidadTest extends TestCase
{
    public function test_acceso_publico(): void
    {
        $usuario = new UsuarioPremium();
        $usuario->nombre = 'Altia';
        $usuario->apellido = 'Developer';
        
        // Al ser public, podemos llamarlo desde aquí sin problema
        $this->assertEquals('Altia Developer', $usuario->getNombreCompletoAttribute());
    }

    public function test_metodo_protegido_error_desde_fuera(): void
    {
        $usuario = new UsuarioPremium();
        
        // Le decimos al test que la siguiente línea rompa la aplicación
        $this->expectException(BadMethodCallException::class);
        
        // Intentar invocar un método 'protected' desde fuera lanza un Error
        $usuario->esAdmin(); 
    }

    public function test_propiedad_privada_error_desde_fuera(): void
    {
        $usuario = new UsuarioPremium();
        
        // La propiedad privada pura es invisible. Eloquent intenta buscarla como columna de BD y devuelve null.
        // Confirmamos que NO nos devuelve el string 'secret'.
        $this->assertNull($usuario->claveInterna);
    }
}