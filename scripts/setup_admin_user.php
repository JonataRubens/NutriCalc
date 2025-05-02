<?php
include __DIR__ . '/../includes/db_connection.php';

// Verifica se já existe um usuário admin
$adminCheck = $conn->query("SELECT id FROM usuarios WHERE role = 'admin'");

if ($adminCheck && $adminCheck->num_rows > 0) {
    echo "Um usuário admin já existe. Setup não será executado novamente.";
    exit;
}

// Cria um usuário admin padrão
$nome = "admin";
$sobrenome = "admin";
$email = "admin@nutricalc.com";
$senha = "admin123"; // Altere esta senha após o login inicial
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
$role = "admin";

$stmt = $conn->prepare("INSERT INTO usuarios (nome, sobrenome, email, senha, role) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nome, $sobrenome, $email, $senhaHash, $role);

if ($stmt->execute()) {
    echo "Usuário admin criado com sucesso. Email: admin@nutricalc.com, Senha: admin123. Por favor, altere a senha após o login inicial.";
} else {
    echo "Erro ao criar usuário admin: " . $conn->error;
}
?>
