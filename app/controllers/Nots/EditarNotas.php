<?php
session_start();
require_once __DIR__ . '/../../../public/includes/db_connection.php';
require_once __DIR__ . '/../../models/Nota.php'; // Inclui o model

if (!isset($_SESSION['usuario_id'])) {
    die('Acesso não autorizado.');
}

$id_usuario = $_SESSION['usuario_id'];

if (!isset($_GET['id'])) {
    die('ID da nota não fornecido.');
}

$id_nota = intval($_GET['id']);

// Usando o model para buscar a nota
$notaModel = new Nota($conn);
$nota = $notaModel->buscarPorId($id_nota, $id_usuario);

if (!$nota) {
    die('Nota não encontrada.');
}

// Atualiza se enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoTitulo = $_POST['titulo'] ?? '';
    $novoConteudo = $_POST['conteudo'] ?? '';

    if (!empty($novoTitulo) && !empty($novoConteudo)) {
        // Usando o model para atualizar a nota
        if ($notaModel->atualizar($id_nota, $novoTitulo, $novoConteudo, $id_usuario)) {
            header("Location: /Urls.php?page=notas");
            exit();
        } else {
            $erro = "Erro ao atualizar nota.";
        }
    } else {
        $erro = "Título e conteúdo são obrigatórios.";
    }
}
include('../public/includes/NavBar.php');
?>

<link rel="stylesheet" href="/assets/css/MinhasNotas.css">
<link rel="stylesheet" href="/assets/css/NewsNotas.css">
<main>
    <h2>Editar Nota</h2>
    <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

    <form method="POST">
        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($nota['titulo']) ?>" required><br><br>

        <label for="conteudo">Conteúdo:</label><br>
        <textarea name="conteudo" id="conteudo" rows="5" required><?= htmlspecialchars($nota['conteudo']) ?></textarea><br><br>

        <button type="submit">✔ Salvar Alterações</button>
    </form>

    <a href="/Urls.php?page=notas" class="botao botao-voltar">⬅️ Voltar</a>
</main>
<?php include('../public/includes/Footer.html'); ?>
