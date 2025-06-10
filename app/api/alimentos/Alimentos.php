<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../controllers/AlimentoAPI.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['termo'])) {
            $termo = $_GET['termo'];
            $alimentos = AlimentosController::filtrar($termo);
            echo json_encode($alimentos);
        } elseif (isset($_GET['categoria'])) {
            $categoria = $_GET['categoria'];
            $alimentos = AlimentosController::filtrarPorCategoria($categoria);
            echo json_encode($alimentos);
        } elseif (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $alimento = AlimentosController::buscarPorId($id);
            echo json_encode($alimento);
        } else {
            $alimentos = AlimentosController::index();
            echo json_encode($alimentos);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $result = AlimentosController::adicionar($data);
        echo json_encode($result);
        break;

    case 'PUT':
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$id || !$data) {
            http_response_code(400);
            echo json_encode(['error' => 'ID ou dados não informados']);
            exit;
        }
        $result = AlimentosController::editar($id, $data);
        echo json_encode($result);
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID não informado']);
            exit;
        }
        $result = AlimentosController::excluir($id);
        echo json_encode($result);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido']);
}