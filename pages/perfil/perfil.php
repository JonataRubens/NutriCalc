<?php
session_start();
require_once('../../includes/db_connection.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$mensagem = "";
$perfil = [
    'peso' => '',
    'idade' => '',
    'altura' => '',
    'ativo' => '',
    'sexo' => '',
    'objetivo' => '',
];

// Verifica se perfil existe
$stmt = $conn->prepare("SELECT * FROM perfil_usuario WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
if ($resultado->num_rows > 0) {
    $perfil = $resultado->fetch_assoc();
}
$stmt->close();

// Salva ou atualiza perfil
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $peso = floatval($_POST['peso']);
    $idade = intval($_POST['idade']);
    $altura = floatval($_POST['altura']);
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    $sexo = $_POST['sexo'];
    $objetivo = $_POST['objetivo'];

    if ($perfil['usuario_id'] ?? false) {
        // Atualizar
        $stmt = $conn->prepare("UPDATE perfil_usuario SET peso = ?, idade = ?, altura = ?, ativo = ?, sexo = ?, objetivo = ? WHERE usuario_id = ?");
        $stmt->bind_param("diidssi", $peso, $idade, $altura, $ativo, $sexo, $objetivo, $usuario_id);
        $mensagem = $stmt->execute() ? "Perfil atualizado com sucesso!" : "Erro ao atualizar perfil.";
    } else {
        // Inserir
        $stmt = $conn->prepare("INSERT INTO perfil_usuario (usuario_id, peso, idade, altura, ativo, sexo, objetivo) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("idiidss", $usuario_id, $peso, $idade, $altura, $ativo, $sexo, $objetivo);
        $mensagem = $stmt->execute() ? "Perfil criado com sucesso!" : "Erro ao criar perfil.";
    }
    $stmt->close();

    // Redireciona após qualquer operação
    header("Location: perfil.php?mensagem=" . urlencode($mensagem));
    exit;
}

// Mensagem da query string
if (isset($_GET['mensagem'])) {
    $mensagem = htmlspecialchars($_GET['mensagem']);
}
?>
<?php include('../../includes/NavBar.php'); ?>

<?php
// Mostra mensagem da query string
if (isset($_GET['mensagem'])) {
    $mensagem = htmlspecialchars($_GET['mensagem']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Perfil do Usuário</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 30px; background-color: #f7f7f7; }
    form { max-width: 500px; background: white; padding: 20px; border-radius: 8px; margin: auto; }
    .form-group { margin-bottom: 15px; }
    label { display: block; font-weight: bold; margin-bottom: 5px; }
    input, select { width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; }
    button { padding: 10px 20px; background-color: #28a745; border: none; color: white; border-radius: 4px; cursor: pointer; }
    button:hover { background-color: #218838; }
    .mensagem { margin-bottom: 15px; color: green; text-align: center; }
  </style>
</head>
<body>

<h2>Perfil do Usuário</h2>

<?php if (!empty($mensagem)): ?>
    <p class="mensagem"><?= $mensagem ?></p>
<?php endif; ?>

<form method="post">
  <div class="form-group">
    <label for="peso">Peso (kg)</label>
    <input type="number" step="0.01" name="peso" id="peso" required value="<?= htmlspecialchars($perfil['peso']) ?>">
  </div>

  <div class="form-group">
    <label for="idade">Idade</label>
    <input type="number" name="idade" id="idade" required value="<?= htmlspecialchars($perfil['idade']) ?>">
  </div>

  <div class="form-group">
    <label for="altura">Altura (m)</label>
    <input type="number" step="0.01" name="altura" id="altura" required value="<?= htmlspecialchars($perfil['altura']) ?>">
  </div>

  <div class="form-group">
    <label for="sexo">Sexo</label>
    <select name="sexo" id="sexo" required>
      <option value="">Selecione</option>
      <option value="M" <?= $perfil['sexo'] == 'M' ? 'selected' : '' ?>>Masculino</option>
      <option value="F" <?= $perfil['sexo'] == 'F' ? 'selected' : '' ?>>Feminino</option>
      <option value="Outro" <?= $perfil['sexo'] == 'Outro' ? 'selected' : '' ?>>Outro</option>
    </select>
  </div>

  <div class="form-group">
    <label for="objetivo">Objetivo</label>
    <select name="objetivo" id="objetivo" required>
      <option value="">Selecione</option>
      <option value="perder_peso" <?= $perfil['objetivo'] == 'perder_peso' ? 'selected' : '' ?>>Perder Peso</option>
      <option value="manter" <?= $perfil['objetivo'] == 'manter' ? 'selected' : '' ?>>Manter</option>
      <option value="ganhar_massa" <?= $perfil['objetivo'] == 'ganhar_massa' ? 'selected' : '' ?>>Ganhar Massa</option>
    </select>
  </div>

  <div class="form-group">
    <label><input type="checkbox" name="ativo" <?= $perfil['ativo'] ? 'checked' : '' ?>> Estou ativo fisicamente</label>
  </div>

  <button type="submit"><?= isset($perfil['usuario_id']) ? 'Atualizar' : 'Salvar' ?> Perfil</button>
</form>

</body>
</html>
