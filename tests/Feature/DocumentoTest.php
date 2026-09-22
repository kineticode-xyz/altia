<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Documento;
use Tests\TestCase;

class DocumentoTest extends TestCase
{
    use RefreshDatabase;

    public function test_generar_codigo_csv(): void
    {
        $codigoCSV = Documento::generarCodigoCsvUnico();

        $this->assertIsString($codigoCSV); //Es una cadena de texto
        $this->assertEquals(12, strlen($codigoCSV));// Es de 12 caracteres
    }

    public function test_codigo_unico() : void {
        $primerCodigo = Documento::generarCodigoCsvUnico();

        Documento::create([
            'nombre' => 'Primer código',
            'csv' => $primerCodigo
        ]);

        $segundoCodigo = Documento::generarCodigoCsvUnico();

        $this->assertNotEquals($primerCodigo, $segundoCodigo, 'Se han generado dos CSV iguales');
    }
}
