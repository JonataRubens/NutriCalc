<?php
include __DIR__ . '/../public/includes/db_connection.php';


// Verifica se a tabela 'usuarios' existe
$tabelaExiste = $conn->query("SHOW TABLES LIKE 'usuarios'");

if ($tabelaExiste && $tabelaExiste->num_rows == 0) {
    // Tabela não existe — vamos criar!
    $sql = "
        CREATE TABLE usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            sobrenome VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ";

    if ($conn->query($sql) === TRUE) {
        echo "Tabela 'usuarios' criada com sucesso.";
    } else {
        echo "Erro ao criar tabela: " . $conn->error;
    }
} else {
    echo "Tabela 'usuarios' já existe.";
}
