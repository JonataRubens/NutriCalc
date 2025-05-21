<?php
require_once 'db_connection.php';

header('Content-Type: application/json');

$searchTerm = isset($_GET['term']) ? $_GET['term'] : '';

if (!empty($searchTerm)) {
    $stmt = $conn->prepare("SELECT * FROM alimentos WHERE descricao LIKE ? OR categoria LIKE ?");
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $alimentos = [];
    while ($row = $result->fetch_assoc()) {
        $alimentos[] = $row;
    }
    
    echo json_encode($alimentos);
    $stmt->close();
} else {
    echo json_encode([]);
}

$conn->close();
?>
