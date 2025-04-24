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
    echo "Tabela 'alimentos' já existe.<br>";
    
    // Verificar se a coluna categoria existe e adicioná-la se necessário
    $verificar_coluna = $conn->query("SHOW COLUMNS FROM alimentos LIKE 'categoria'");
    if ($verificar_coluna->num_rows == 0) {
        $sql_adicionar_coluna = "ALTER TABLE alimentos ADD COLUMN categoria VARCHAR(100) AFTER descricao";
        
        if ($conn->query($sql_adicionar_coluna) === TRUE) {
            echo "Coluna 'categoria' adicionada na tabela 'alimentos'.<br>";
        } else {
            echo "Erro ao adicionar coluna: " . $conn->error . "<br>";
        }
    }
}

// Inserir alimentos com suas categorias
$alimentos = [
    // [descricao, categoria, energia, proteina, lipideos, carboidratos]
    ['Arroz branco cozido', 'Cereais', 128.0, 2.5, 0.2, 28.1],
    ['Feijão preto cozido', 'Leguminosas', 77.0, 4.5, 0.5, 14.0],
    ['Alface crua', 'Hortaliças', 14.0, 1.3, 0.2, 2.4],
    ['Banana prata', 'Frutas', 98.0, 1.3, 0.1, 26.0],
    ['Carne bovina (contra-filé) grelhada', 'Carnes', 219.0, 32.0, 9.2, 0.0],
    ['Leite integral UHT', 'Leite e derivados', 61.0, 3.2, 3.3, 4.6],
    ['Azeite de oliva', 'Óleos e gorduras', 884.0, 0.0, 100.0, 0.0],
    ['Açúcar refinado', 'Açúcares e doces', 387.0, 0.0, 0.0, 99.6]
];

// Verificar se já existem alimentos na tabela
$verificar_alimentos = $conn->query("SELECT COUNT(*) as total FROM alimentos");
$row = $verificar_alimentos->fetch_assoc();

// Só inserir se não existirem alimentos
if ($row['total'] == 0) {
    foreach ($alimentos as $alimento) {
        // Inserir o alimento com a categoria como texto
        $stmt = $conn->prepare("INSERT INTO alimentos (descricao, categoria, energia, proteina, lipideos, carboidratos) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdddd", $alimento[0], $alimento[1], $alimento[2], $alimento[3], $alimento[4], $alimento[5]);
        
        if ($stmt->execute()) {
            echo "Alimento '{$alimento[0]}' inserido com sucesso.<br>";
        } else {
            echo "Erro ao inserir alimento '{$alimento[0]}': " . $stmt->error . "<br>";
        }
        
        $stmt->close();
    }
} else {
    echo "Alimentos já existem na tabela. Pulando inserção.<br>";
}

$conn->close();
echo "Processo de configuração completo!"; 