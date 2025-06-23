<?php
use PHPUnit\Framework\TestCase;

class RedirectTest extends TestCase
{
    public function testRedirectComHeader()
    {
        // Usa output buffering para capturar headers
        if (!function_exists('xdebug_get_headers')) {
            $this->markTestSkipped('xdebug não disponível para testar headers');
        }

        // Limpa headers anteriores
        if (function_exists('xdebug_get_headers')) {
            xdebug_get_headers();
        }

        // Simula redirecionamento
        header('Location: /login');
        
        // Verifica se header foi definido
        $headers = xdebug_get_headers();
        $this->assertContains('Location: /login', $headers);
    }

    public function testRedirectComMock()
    {
        // Cria um mock para testar redirecionamento
        $redirectMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['redirect'])
            ->getMock();

        $redirectMock->expects($this->once())
            ->method('redirect')
            ->with('/')
            ->willReturnCallback(function($url) {
                throw new Exception("Redirect to: $url");
            });

        // Testa se o redirecionamento é chamado
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Redirect to: /');
        
        $redirectMock->redirect('/');
    }
}
