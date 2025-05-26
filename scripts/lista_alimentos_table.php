<?php
echo "Criando tabela lista_alimentos...\n";

include __DIR__ . '/../public/includes/db_connection.php';

// Verifica se a tabela 'lista_alimentos' existe
$tabelaExiste = $conn->query("SHOW TABLES LIKE 'lista_alimentos'");

if ($tabelaExiste && $tabelaExiste->num_rows == 0) {
    $sql = "
        CREATE TABLE lista_alimentos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_usuario INT NOT NULL,
            id_alimento INT NOT NULL,
            descricao VARCHAR(255) NOT NULL,
            categoria VARCHAR(100) NOT NULL,
            energia VARCHAR(20) NOT NULL,
            proteina VARCHAR(20) NOT NULL,
            lipideos VARCHAR(20) NOT NULL,
            carboidratos VARCHAR(20) NOT NULL,
            data_adicao DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
            UNIQUE KEY unique_user_alimento (id_usuario, id_alimento)
        );
    ";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Tabela 'lista_alimentos' criada com sucesso!\n";
    } else {
        echo "❌ Erro ao criar tabela: " . $conn->error . "\n";
    }
} else {
    echo "ℹ️ Tabela 'lista_alimentos' já existe.\n";
}
?>
