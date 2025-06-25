<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db_connection.php';
require_once __DIR__ . '/../../app/controllers/AlimentosControllerAPI.php';

$method = $_SERVER['REQUEST_METHOD'];
$acao = $_GET['acao'] ?? ''; // Added to handle different actions

switch ($method) {
    case 'GET':
        // Filtro por termo
        if (isset($_GET['termo'])) {
            $termo = $_GET['termo'];
            $alimentos = AlimentosController::filtrar($conn, $termo);
            echo json_encode($alimentos);
        // Filtro por categoria
        } elseif (isset($_GET['categoria'])) {
            $categoria = $_GET['categoria'];
            $alimentos = AlimentosController::filtrarPorCategoria($conn, $categoria);
            echo json_encode($alimentos);
        } elseif ($acao === 'get_similar_by_calories' && isset($_GET['energia'])) { // New action
            $energia = (float)$_GET['energia'];
            // MODIFICAÇÃO AQUI: Captura o exclude_id da URL
            $excludeId = isset($_GET['exclude_id']) ? (int)$_GET['exclude_id'] : null;
            $alimentos = AlimentosController::getSimilarByCalories($conn, $energia, $excludeId); // MODIFICAÇÃO AQUI: Passa o excludeId
            echo json_encode($alimentos);
        } else {
            $alimentos = AlimentosController::listar($conn);
            echo json_encode($alimentos);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['descricao'], $data['categoria'], $data['energia'], $data['proteina'], $data['lipideos'], $data['carboidratos'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Dados incompletos']);
            exit;
        }
        $result = AlimentosController::adicionar($conn, $data);
        if (isset($result['success'])) {
            echo json_encode($result);
        } else {
            http_response_code(500);
            echo json_encode($result);
        }
        break;

    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID não informado']);
            exit;
        }
        $data = json_decode(json_encode($put_vars), true);
        if (!isset($data['descricao'], $data['categoria'], $data['energia'], $data['proteina'], $data['lipideos'], $data['carboidratos'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Dados incompletos']);
            exit;
        }
        $result = AlimentosController::editar($conn, $id, $data);
        if (isset($result['success'])) {
            echo json_encode($result);
        } else {
            http_response_code(500);
            echo json_encode($result);
        }
        break;

    case 'DELETE':
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID não informado']);
            exit;
        }
        $result = AlimentosController::deletar($conn, $_GET['id']);
        if (isset($result['success'])) {
            echo json_encode($result);
        } else {
            http_response_code(500);
            echo json_encode($result);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido']);
}