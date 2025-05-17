<?php
// Configura cabeçalhos para API REST
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Inclui conexão mysqli
require __DIR__ . '/../includes/db_connection.php'; // $conn deve estar disponível

$method = $_SERVER['REQUEST_METHOD'];

// Função para listar todos os alimentos
function getAlimentos($conn) {
    $sql = "SELECT * FROM alimentos";
    $result = $conn->query($sql);
    $alimentos = [];
    while ($row = $result->fetch_assoc()) {
        $alimentos[] = $row;
    }
    echo json_encode($alimentos);
}

// Função para adicionar alimento
function addAlimento($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['descricao'], $data['categoria'], $data['energia'], $data['proteina'], $data['lipideos'], $data['carboidratos'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Dados incompletos']);
        return;
    }
    $sql = "INSERT INTO alimentos (descricao, categoria, energia, proteina, lipideos, carboidratos) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssdddd",
        $data['descricao'],
        $data['categoria'],
        $data['energia'],
        $data['proteina'],
        $data['lipideos'],
        $data['carboidratos']
    );
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'id' => $conn->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao inserir alimento']);
    }
}

// Função para deletar alimento
function deleteAlimento($conn, $id) {
    $sql = "DELETE FROM alimentos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao deletar alimento']);
    }
}

// Roteamento simples
switch ($method) {
    case 'GET':
        getAlimentos($conn);
        break;
    case 'POST':
        addAlimento($conn);
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            deleteAlimento($conn, intval($_GET['id']));
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'ID não informado']);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido']);
}
?>