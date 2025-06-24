<?php
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    public function testSessaoVazia()
    {
        $_SESSION = [];
        $this->assertEmpty($_SESSION);
        $this->assertArrayNotHasKey('usuario_id', $_SESSION);
    }

    public function testSessaoComDados()
    {
        $_SESSION['usuario_id'] = 123;
        $_SESSION['usuario_nome'] = 'João';
        
        $this->assertNotEmpty($_SESSION);
        $this->assertArrayHasKey('usuario_id', $_SESSION);
        $this->assertEquals(123, $_SESSION['usuario_id']);
        $this->assertEquals('João', $_SESSION['usuario_nome']);
    }

    public function testLimpezaSessao()
    {
        $_SESSION['usuario_id'] = 123;
        unset($_SESSION['usuario_id']);
        
        $this->assertArrayNotHasKey('usuario_id', $_SESSION);
    }
}
