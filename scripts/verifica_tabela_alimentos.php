<?php
include __DIR__ . '/../includes/db_connection.php';

// Verificar se a tabela 'alimentos' existe
$tabelaExiste = $conn->query("SHOW TABLES LIKE 'alimentos'");

if ($tabelaExiste && $tabelaExiste->num_rows == 0) {
    // Tabela não existe — vamos criar com campo de categoria simples
    $sql = "
        CREATE TABLE alimentos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            descricao VARCHAR(255) NOT NULL,
            categoria VARCHAR(100) NOT NULL,
            energia DECIMAL(10,2) NOT NULL,
            proteina DECIMAL(10,2) NOT NULL,
            lipideos DECIMAL(10,2) NOT NULL,
            carboidratos DECIMAL(10,2) NOT NULL,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ";

    if ($conn->query($sql) === TRUE) {
        echo "Tabela 'alimentos' criada com sucesso.<br>";
    } else {
        echo "Erro ao criar tabela: " . $conn->error . "<br>";
    }
} else {
    echo "Tabela 'alimentos' já existe. Setup não será executado novamente.<br>";
    $conn->close();
    exit;
}


$conn->close();
echo "Processo de configuração completo!";
