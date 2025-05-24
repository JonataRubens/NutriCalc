<?php
// app/controllers/perfil/Perfil.php
session_start();
require_once __DIR__ . '/../../../public/includes/db_connection.php';
require_once __DIR__ . '/../../models/Perfil.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$mensagem = "";

// Usando o model
$perfilModel = new Perfil($conn);
$perfil = $perfilModel->buscarPorUsuario($usuario_id);

// Salva ou atualiza perfil

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dados = [
        'peso' => floatval($_POST['peso']),
        'idade' => intval($_POST['idade']),
        'altura' => floatval($_POST['altura']),
        'ativo' => isset($_POST['ativo']) ? 1 : 0,
        'sexo' => $_POST['sexo'],
        'objetivo' => $_POST['objetivo']
    ];
    
    $mensagem = $perfilModel->salvar($usuario_id, $dados);
    
    // Redireciona após qualquer operação
    header("Location: /Urls.php?page=perfil&mensagem=" . urlencode($mensagem));
    exit;
}

// Mensagem da query string
if (isset($_GET['mensagem'])) {
    $mensagem = htmlspecialchars($_GET['mensagem']);
}

// Mensagem da query string
if (isset($_GET['mensagem'])) {
    $mensagem = htmlspecialchars($_GET['mensagem']);
}
?>


<?php
// Mostra mensagem da query string
if (isset($_GET['mensagem'])) {
    $mensagem = htmlspecialchars($_GET['mensagem']);
}
?>

<main>
<head>
  <meta charset="UTF-8">
  <title>Perfil do Usuário</title>
</head>
<?php include('../public/includes/NavBar.php'); ?>
<link rel="stylesheet" href="/assets/css/Perfil.css">
<body>

<div class="profile-box">

  <h2 class="profile-title">Perfil do Usuário</h2>
  <?php if (!empty($mensagem)): ?>
      <p class="mensagem"><?= $mensagem ?></p>
  <?php endif; ?>

  <form method="post">
    <div class="form-row">
      <div class="form-group">
        <label for="peso">Peso (kg)</label>
        <input type="number" step="0.01" name="peso" id="peso" required value="<?= htmlspecialchars($perfil['peso']) ?>">
      </div>
      <div class="form-group">
        <label for="idade">Idade</label>
        <input type="number" name="idade" id="idade" required value="<?= htmlspecialchars($perfil['idade']) ?>">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label for="altura">Altura (m)</label>
        <input type="text" name="altura" id="altura" required value="<?= htmlspecialchars($perfil['altura']) ?>">
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
    </div>
    <div class="form-row">
      <div class="form-group">
        <label for="objetivo">Objetivo</label>
        <select name="objetivo" id="objetivo" required>
          <option value="">Selecione</option>
          <option value="perder_peso" <?= $perfil['objetivo'] == 'perder_peso' ? 'selected' : '' ?>>Perder Peso</option>
          <option value="manter" <?= $perfil['objetivo'] == 'manter' ? 'selected' : '' ?>>Manter</option>
          <option value="ganhar_massa" <?= $perfil['objetivo'] == 'ganhar_massa' ? 'selected' : '' ?>>Ganhar Massa</option>
        </select>
      </div>
      <div class="form-group" style="align-items: center; display: flex;">
        <!-- <label>
          <input type="checkbox" name="ativo" <?= $perfil['ativo'] ? 'checked' : '' ?>> Estou ativo fisicamente
        </label> -->
      </div>
    </div>
    <button type="submit"><?= isset($perfil['usuario_id']) ? 'Atualizar' : 'Salvar' ?> Perfil</button>
  </form>
</div>
  </main>

<?php include('../public/includes/Footer.html'); ?>
