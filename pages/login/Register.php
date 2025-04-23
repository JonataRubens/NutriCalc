<?php
// Inicia o PHP
include '../../includes/db_connection.php';

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $sobrenome = trim($_POST['sobrenome']);
    $email = trim($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Segurança

    // Verifica se o e-mail já existe
    $verifica = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $verifica->bind_param("s", $email);
    $verifica->execute();
    $verifica->store_result();

    if ($verifica->num_rows > 0) {
        $mensagem = "Este e-mail já está cadastrado.";
    } else {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $sobrenome, $email, $senha);

        if ($stmt->execute()) {
          header("Location: /index.php");
          exit;
        } else {
          $mensagem = "Erro ao cadastrar: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/Register.css">

</head>
<body>

  <div class="card">
    <h1>Crie sua conta</h1>
    <?php if ($mensagem): ?>
        <p><?= $mensagem ?></p>
    <?php endif; ?>
    <form id="cadastroForm" action="Register.php" method="POST">
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" required />
  </div>

  <div class="form-group">
    <label for="sobrenome">Sobrenome</label>
    <input type="text" id="sobrenome" name="sobrenome" required />
  </div>

  <div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" required />
  </div>

  <div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" id="senha" name="senha" required />
    <div class="error" id="erroSenha"></div>
  </div>

  <button type="submit">Cadastrar</button>
</form>
  </div>

  <script>
    const form = document.getElementById("cadastroForm");
    const senha = document.getElementById("senha");
    const erroSenha = document.getElementById("erroSenha");

    form.addEventListener("submit", function (e) {
      if (senha.value.length < 8) {
        e.preventDefault();
        erroSenha.textContent = "A senha deve ter no mínimo 8 caracteres.";
      } else {
        erroSenha.textContent = "";
        alert("Cadastro realizado com sucesso!");
      }
    });
  </script>

</body>
</html>
