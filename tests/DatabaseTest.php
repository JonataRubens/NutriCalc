<?php
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function testConexaoBancoDados()
    {
        // Testa se o arquivo de conexão existe
        $dbFile = __DIR__ . '/../public/includes/db_connection.php';
        $this->assertFileExists($dbFile, 'Arquivo de conexão não encontrado');
    }

    public function testConexaoSQLite()
    {
        // Testa conexão com SQLite (para testes)
        $conn = new PDO('sqlite::memory:');
        $this->assertInstanceOf(PDO::class, $conn);
        
        // Testa uma query simples
        $result = $conn->query('SELECT 1 as test');
        $this->assertNotFalse($result);
    }

    public function testCriacaoTabelaTeste()
    {
        $conn = new PDO('sqlite::memory:');
        
        // Cria tabela de exemplo
        $sql = "CREATE TABLE alimentos (
            id INTEGER PRIMARY KEY,
            nome TEXT NOT NULL,
            calorias INTEGER
        )";
        
        $result = $conn->exec($sql);
        $this->assertNotFalse($result);
        
        // Insere dados de teste
        $stmt = $conn->prepare("INSERT INTO alimentos (nome, calorias) VALUES (?, ?)");
        $resultado = $stmt->execute(['Maçã', 52]);
        $this->assertTrue($resultado);
    }
}
