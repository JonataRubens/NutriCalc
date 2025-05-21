<?php
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['user_id'])) {
    // Se já estiver logado, redireciona para o painel administrativo
    header('Location: Dashboard.php');
    exit();
}

include_once __DIR__ . '/../../../public/includes/db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o usuário existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verifica se a senha está correta
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id']; // Armazena o ID do usuário na sessão

            // Redireciona para o painel administrativo (não importa se superusuário ou normal)
            header('Location: Dashboard.php');
            exit();
        } else {
            $error = "Senha incorreta!";
        }
    } else {
        $error = "Usuário não encontrado!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f7f7f7;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

h1 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

/* Formulário de Login */
.form-login {
    background-color: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 350px;
    text-align: center;
}

/* Inputs */
.form-login input[type="email"], 
.form-login input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 16px;
    background-color: #f5f5f5;
    color: #333;
    box-sizing: border-box;
}

/* Icone de senha */
.form-login input[type="password"] {
    position: relative;
}

.form-login input[type="password"]::after {
    content: '\1F512'; /* Ícone de cadeado */
    font-size: 20px;
    color: #888;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
}

/* Botão */
.form-login button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-login button:hover {
    background-color: #0056b3;
}

/* Estilo para o texto de erro */
.error {
    color: red;
    font-size: 14px;
    margin-top: -15px;
    margin-bottom: 15px;
}
</style>
<body>
    <div class="form-login">
        <h1>Login</h1>
        <form method="POST" action="admin.php">
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
