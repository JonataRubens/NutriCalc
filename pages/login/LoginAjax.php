<?php
session_start();
include_once __DIR__ . '/../../includes/db_connection.php';


header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Busca o usuário pelo e-mail
    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Verifica se encontrou o usuário
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $nome, $senha_hash);
        $stmt->fetch();

        // Verifica a senha
        if (password_verify($senha, $senha_hash)) {
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nome'] = $nome;
            $response['success'] = true;
        } else {
            $response['message'] = "Senha incorreta.";
        }
    } else {
        $response['message'] = "E-mail não encontrado.";
    }
}

echo json_encode($response);
?>