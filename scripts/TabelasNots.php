<?php
include __DIR__ . '/../includes/db_connection.php';

// Verifica se a tabela 'notas' existe
$tabelaExiste = $conn->query("SHOW TABLES LIKE 'notas'");

if ($tabelaExiste && $tabelaExiste->num_rows == 0) {
    // Tabela não existe — vamos criar!
    $sql = "
        CREATE TABLE notas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_usuario INT NOT NULL,
            titulo VARCHAR(255) NOT NULL,
            conteudo TEXT NOT NULL,
            data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
        );
    ";

    if ($conn->query($sql) === TRUE) {
        echo "Tabela 'notas' criada com sucesso.";
    } else {
        echo "Erro ao criar tabela: " . $conn->error;
    }
} else {
    echo "Tabela 'notas' já existe.";
}
