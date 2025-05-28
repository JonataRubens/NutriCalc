<?php
// NutriCalc/public/includes/get_substitutes.php
require_once 'db_connection.php';

header('Content-Type: application/json');

$searchTerm = isset($_GET['term']) ? $_GET['term'] : '';

if (!empty($searchTerm)) {
    // 1.  Get the caloric value of the searched food
    $stmt = $conn->prepare("SELECT id, descricao, categoria, energia, carboidratos, proteina, lipideos FROM lista_alimentos WHERE descricao LIKE ?"); // Using "lista_alimentos"
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $food = $result->fetch_assoc();

    if ($food) {
        $targetCalories = $food['energia'];

        // 2.  Find substitutes with calories <= target, ordered by closest value
        $stmt = $conn->prepare("SELECT id, descricao, categoria, energia, carboidratos, proteina, lipideos, (ABS(energia - ?)) as diff FROM lista_alimentos WHERE energia <= ? ORDER BY diff ASC"); // Using "lista_alimentos"
        $stmt->bind_param("dd", $targetCalories, $targetCalories);
        $stmt->execute();
        $result = $stmt->get_result();

        $substitutes = [];
        while ($row = $result->fetch_assoc()) {
            $substitutes[] = $row;
        }

        echo json_encode(['food' => $food, 'substitutes' => $substitutes]);
    } else {
        echo json_encode(['food' => null, 'substitutes' => []]); // Or a message indicating no food found
    }

    $stmt->close();
} else {
    echo json_encode(['food' => null, 'substitutes' => []]);
}

$conn->close();
?>