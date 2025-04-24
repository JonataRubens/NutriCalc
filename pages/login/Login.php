<?php
session_start();
include '../../includes/db_connection.php';

$mensagem = "";

// Captura a URL de retorno (pode vir da sessão ou do GET)
if (isset($_GET['redirect'])) {
    $_SESSION['url_retorno'] = $_GET['redirect'];
}

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

            // Redireciona para a página anterior (ou index como fallback)
            $redirect = $_SESSION['url_retorno'] ?? '/index.php';
            unset($_SESSION['url_retorno']); // limpa a sessão
            header("Location: $redirect");
            exit;
        } else {
            $mensagem = "Senha incorreta.";
        }
    } else {
        $mensagem = "E-mail não encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <link rel="stylesheet" href="../../assets/css/Login.css">
</head>
<body>

  <div class="card">
    <h1>Login</h1>
    <?php if ($mensagem): ?>
      <p><?= $mensagem ?></p>
    <?php endif; ?>
    <form action="Login.php<?php if (isset($_GET['redirect'])) echo '?redirect=' . urlencode($_GET['redirect']); ?>" method="POST">
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required />
      </div>

      <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required />
      </div>

      <button type="submit">Entrar</button>
    </form>
  </div>

</body>
</html>
