<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

session_start();
require_once __DIR__ . '/../includes/roleMiddleware.php';
roleMiddleware(['admin']);

require __DIR__ . '/../includes/db_connection.php'; // $conn deve estar disponível

$method = $_SERVER['REQUEST_METHOD'];

// Listar todos os usuários
function getUsuarios($conn) {
    $sql = "SELECT id, nome, sobrenome, email, role, criado_em FROM usuarios";
    $result = $conn->query($sql);
    $usuarios = [];
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
    echo json_encode($usuarios);
}

// Buscar usuário por ID
function getUsuarioById($conn, $id) {
    $sql = "SELECT id, nome, sobrenome, email, role, criado_em FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    if ($usuario) {
        echo json_encode($usuario);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Usuário não encontrado']);
    }
}

// Adicionar usuário
function addUsuario($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['nome'], $data['sobrenome'], $data['email'], $data['senha'], $data['role'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Dados incompletos']);
        return;
    }
    $senhaHash = password_hash($data['senha'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nome, sobrenome, email, senha, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $data['nome'], $data['sobrenome'], $data['email'], $senhaHash, $data['role']);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'id' => $conn->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao inserir usuário']);
    }
}

// Atualizar usuário
function updateUsuario($conn, $id) {
    $data = json_decode(file_get_contents('php://input'), true);
    $campos = [];
    $tipos = '';
    $valores = [];
    foreach (['nome', 'sobrenome', 'email', 'senha', 'role'] as $campo) {
        if (isset($data[$campo])) {
            if ($campo === 'senha') {
                $campos[] = "senha = ?";
                $tipos .= 's';
                $valores[] = password_hash($data['senha'], PASSWORD_DEFAULT);
            } else {
                $campos[] = "$campo = ?";
                $tipos .= 's';
                $valores[] = $data[$campo];
            }
        }
    }
    if (empty($campos)) {
        http_response_code(400);
        echo json_encode(['error' => 'Nenhum dado para atualizar']);
        return;
    }
    $valores[] = $id;
    $tipos .= 'i';
    $sql = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($tipos, ...$valores);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao atualizar usuário']);
    }
}

// Deletar usuário
function deleteUsuario($conn, $id) {
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao deletar usuário']);
    }
}

// Roteamento
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            getUsuarioById($conn, intval($_GET['id']));
        } else {
            getUsuarios($conn);
        }
        break;
    case 'POST':
        addUsuario($conn);
        break;
    case 'PUT':
        if (isset($_GET['id'])) {
            updateUsuario($conn, intval($_GET['id']));
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'ID não informado']);
        }
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            deleteUsuario($conn, intval($_GET['id']));
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