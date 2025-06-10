<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../controllers/UsuarioAPI.php';
require_once __DIR__ . '/../../../public/includes/db_connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$conn = getDbConnection();

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $usuario = Usuario::buscarPorId($conn, intval($_GET['id']));
            echo json_encode($usuario);
        } else {
            $usuarios = Usuario::listar($conn);
            echo json_encode($usuarios);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Dados não informados']);
            exit;
        }
        $result = Usuario::adicionar($conn, $data);
        if (strpos($result, 'sucesso') !== false) {
            echo json_encode(['success' => true, 'message' => $result]);
        } else {
            echo json_encode(['success' => false, 'message' => $result]);
        }
        break;

    case 'PUT':
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$id || !$data) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID ou dados não informados']);
            exit;
        }
        $result = Usuario::editar($conn, $id, $data);
        if (strpos($result, 'sucesso') !== false) {
            echo json_encode(['success' => true, 'message' => $result]);
        } else {
            echo json_encode(['success' => false, 'message' => $result]);
        }
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID não informado']);
            exit;
        }
        $result = Usuario::excluir($conn, $id);
        if (strpos($result, 'sucesso') !== false) {
            echo json_encode(['success' => true, 'message' => $result]);
        } else {
            echo json_encode(['success' => false, 'message' => $result]);
        }
        break;

    default:
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Método não permitido']);
        exit;
}
?>