<?php
include __DIR__ . '/../includes/db_connection.php';

// Dados do usuário admin
$nome = 'admin';
$sobrenome = 'admin';
$email = 'admin@nutricalc.com';
$senha = password_hash('admin123', PASSWORD_DEFAULT); // Senha criptografada
$role = 'admin';

// Verifica se já existe um admin com esse e-mail
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Usuário admin já existe.";
} else {
    // Insere o usuário admin
    $sql = "INSERT INTO usuarios (nome, sobrenome, email, senha, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $sobrenome, $email, $senha, $role);

    if ($stmt->execute()) {
        echo "Usuário admin criado com sucesso!";
    } else {
        echo "Erro ao criar usuário admin: " . $stmt->error;
    }
}

$conn->close();
?>