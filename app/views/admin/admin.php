<?php
session_start();
include_once __DIR__ . '/../../../public/includes/db_connection.php';

// Se já está logado, redireciona para o dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: /Urls.php?page=admin&action=dash');
    exit();
}

// Processa o login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: /Urls.php?page=admin&action=dash');
            exit();
        } else {
            $error = "Senha incorreta!";
        }
    } else {
        $error = "Usuário não encontrado!";
    }
    $conn->close();
}

// Exibe o formulário de login normalmente (HTML igual ao seu)
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<link rel="stylesheet" href="/assets/css/AdminLogin.css">
<body>
    <div class="form-login">
        <h1>Login</h1>
        <form method="POST" action="/Urls.php?page=admin">
            <label for="email">Email</label>
            <input type="email" name="email" required><br>

            <label for="senha">Senha</label>
            <input type="password" name="senha" required><br>

            <button type="submit">Entrar</button>
        </form>

        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    </div>

</body>
</html>
