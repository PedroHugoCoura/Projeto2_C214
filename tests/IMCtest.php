<?php
namespace Test;
use PHPUnit\Framework\TestCase;
use App;  // Importe o namespace onde calcularIMC foi definido

require_once dirname(__DIR__) . '/src/index.php';  // Caminho correto

class IMCTest extends TestCase {
   
    // Testes de Sucesso
    public function testCalculoIMCSucesso() {
        $imc = App\calcularIMC(70, 1.75);  // Chamada com o namespace correto
        $this->assertEquals(22.86, number_format($imc, 2));
    }

    public function testClassificacaoAbaixoDoPeso() {
        $categoria = App\classificarIMC(17.5);
        $this->assertEquals("Abaixo do peso", $categoria);
    }
    
    public function testClassificacaoPesoNormal() {
        $categoria = App\classificarIMC(22.0);
        $this->assertEquals("Peso normal", $categoria);
    }
    
    public function testClassificacaoSobrepeso() {
        $categoria = App\classificarIMC(27.0);
        $this->assertEquals("Sobrepeso", $categoria);
    }
    
    public function testClassificacaoObesidade() {
        $categoria = App\classificarIMC(32.0);
        $this->assertEquals("Obesidade", $categoria);
    }
    
    // Testes de Falha
    public function testCalculoIMCAlturaZero() {
        $imc = App\calcularIMC(70, 0);
        $this->assertEquals(0, $imc);
    }
    
    public function testCalculoIMCAlturaNegativa() {
        $imc = App\calcularIMC(70, -1.75);
        $this->assertEquals(0, $imc);
    }
        
    public function testCalculoIMCPesoZero() {
        $imc = App\calcularIMC(0, 1.75);
        $this->assertEquals(0, $imc);
    }
    
    public function testCalculoIMCValoresExtremos() {
        $imc = App\calcularIMC(300, 2.5);
        $this->assertEquals(48.0, number_format($imc, 1));
    }
}
?>
