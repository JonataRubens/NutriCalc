<?php
include __DIR__ . '/../public/includes/db_connection.php';

// Verifica se a tabela 'perfil_usuario' existe
$tabelaExiste = $conn->query("SHOW TABLES LIKE 'perfil_usuario'");

if ($tabelaExiste && $tabelaExiste->num_rows == 0) {
    // Tabela não existe — vamos criar!
    $sql = "
        CREATE TABLE perfil_usuario (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT NOT NULL,
            peso DECIMAL(5,2) NOT NULL,
            idade INT NOT NULL,
            altura DECIMAL(4,2) NOT NULL,
            ativo BOOLEAN DEFAULT FALSE,
            sexo ENUM('M', 'F', 'Outro') NOT NULL,
            objetivo ENUM('perder_peso', 'manter', 'ganhar_massa') NOT NULL,
            criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
        );
    ";

    if ($conn->query($sql) === TRUE) {
        echo "Tabela 'perfil_usuario' criada com sucesso.";
    } else {
        echo "Erro ao criar tabela: " . $conn->error;
    }
} else {
    echo "Tabela 'perfil_usuario' já existe.";
}
