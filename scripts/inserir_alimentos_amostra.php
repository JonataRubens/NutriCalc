<?php
include __DIR__ . '/../includes/db_connection.php';

// Array de alimentos de diferentes categorias baseados na tabela TACO
// [descricao, categoria, energia, proteina, lipideos, carboidratos]
$alimentos = [
    // Cereais
    ['Arroz branco cozido', 'Cereais', 128.0, 2.5, 0.2, 28.1],
    ['Arroz integral cozido', 'Cereais', 124.0, 2.6, 1.0, 25.8],
    ['Pão de forma integral', 'Cereais', 247.0, 9.2, 3.3, 44.5],
    
    // Leguminosas
    ['Feijão preto cozido', 'Leguminosas', 77.0, 4.5, 0.5, 14.0],
    ['Lentilha cozida', 'Leguminosas', 93.0, 6.3, 0.5, 16.3],
    ['Grão-de-bico cozido', 'Leguminosas', 164.0, 8.9, 2.6, 27.4],
    
    // Hortaliças
    ['Alface crua', 'Hortaliças', 14.0, 1.3, 0.2, 2.4],
    ['Tomate cru', 'Hortaliças', 15.0, 1.1, 0.2, 3.1],
    ['Cenoura crua', 'Hortaliças', 34.0, 1.0, 0.2, 7.7],
    
    // Frutas
    ['Banana prata', 'Frutas', 98.0, 1.3, 0.1, 26.0],
    ['Maçã com casca', 'Frutas', 85.0, 0.3, 0.2, 22.0],
    ['Laranja', 'Frutas', 46.0, 1.0, 0.1, 11.5],
    
    // Carnes
    ['Carne bovina (contra-filé) grelhada', 'Carnes', 219.0, 32.0, 9.2, 0.0],
    ['Peito de frango grelhado', 'Carnes', 165.0, 31.0, 3.6, 0.0],
    ['Peixe (tilápia) grelhado', 'Carnes', 96.0, 20.1, 1.7, 0.0],
    
    // Leite e derivados
    ['Leite integral UHT', 'Leite e derivados', 61.0, 3.2, 3.3, 4.6],
    ['Iogurte natural integral', 'Leite e derivados', 66.0, 3.5, 3.9, 4.7],
    ['Queijo muçarela', 'Leite e derivados', 330.0, 22.0, 25.0, 2.4],
    
    // Óleos e gorduras
    ['Azeite de oliva', 'Óleos e gorduras', 884.0, 0.0, 100.0, 0.0],
    ['Manteiga com sal', 'Óleos e gorduras', 726.0, 0.9, 82.0, 0.1],
    ['Óleo de soja', 'Óleos e gorduras', 884.0, 0.0, 100.0, 0.0],
    
    // Açúcares e doces
    ['Açúcar refinado', 'Açúcares e doces', 387.0, 0.0, 0.0, 99.6],
    ['Mel', 'Açúcares e doces', 304.0, 0.3, 0.0, 82.4],
    ['Chocolate ao leite', 'Açúcares e doces', 540.0, 7.0, 30.0, 58.0]
];

// Insere os alimentos no banco de dados
foreach ($alimentos as $alimento) {
    $stmt = $conn->prepare("INSERT INTO alimentos (descricao, categoria, energia, proteina, lipideos, carboidratos) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdddd", $alimento[0], $alimento[1], $alimento[2], $alimento[3], $alimento[4], $alimento[5]);
    
    if ($stmt->execute()) {
        echo "Alimento '{$alimento[0]}' inserido com sucesso.<br>";
    } else {
        echo "Erro ao inserir alimento '{$alimento[0]}': " . $stmt->error . "<br>";
    }
    
    $stmt->close();
}

$conn->close();
echo "Processo de inserção concluído!";
