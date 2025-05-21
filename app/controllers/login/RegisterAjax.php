<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../../../public/includes/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $sobrenome = trim($_POST['sobrenome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (strlen($senha) < 8) {
        echo json_encode(["success" => false, "message" => "A senha deve ter pelo menos 8 caracteres."]);
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $verifica = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $verifica->bind_param("s", $email);
    $verifica->execute();
    $verifica->store_result();

    if ($verifica->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Este e-mail já está cadastrado."]);
    } else {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $sobrenome, $email, $senhaHash);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao cadastrar: " . $conn->error]);
        }
    }
}
?>