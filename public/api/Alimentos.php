<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db_connection.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $result = $conn->query("SELECT * FROM alimentos");
        $alimentos = [];
        while ($row = $result->fetch_assoc()) {
            $alimentos[] = $row;
        }
        echo json_encode($alimentos);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['descricao'], $data['categoria'], $data['energia'], $data['proteina'], $data['lipideos'], $data['carboidratos'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Dados incompletos']);
            exit;
        }
        $stmt = $conn->prepare("INSERT INTO alimentos (descricao, categoria, energia, proteina, lipideos, carboidratos) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdddd", $data['descricao'], $data['categoria'], $data['energia'], $data['proteina'], $data['lipideos'], $data['carboidratos']);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'id' => $conn->insert_id]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao inserir alimento']);
        }
        break;

    case 'DELETE':
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID não informado']);
            exit;
        }
        $stmt = $conn->prepare("DELETE FROM alimentos WHERE id = ?");
        $stmt->bind_param("i", $_GET['id']);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao deletar alimento']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido']);
}