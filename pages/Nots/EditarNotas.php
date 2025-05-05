<?php
session_start();
require_once '../../includes/db_connection.php';

$id_usuario = $_SESSION['usuario_id'] ?? 1;

if (!isset($_GET['id'])) {
    die('ID da nota não fornecido.');
}

$id_nota = intval($_GET['id']);

// Busca a nota
$stmt = $conn->prepare("SELECT titulo, conteudo FROM notas WHERE id = ? AND id_usuario = ?");
$stmt->bind_param("ii", $id_nota, $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die('Nota não encontrada.');
}

$nota = $result->fetch_assoc();

// Atualiza se enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoTitulo = $_POST['titulo'] ?? '';
    $novoConteudo = $_POST['conteudo'] ?? '';

    if (!empty($novoTitulo) && !empty($novoConteudo)) {
        $update = $conn->prepare("UPDATE notas SET titulo = ?, conteudo = ? WHERE id = ? AND id_usuario = ?");
        $update->bind_param("ssii", $novoTitulo, $novoConteudo, $id_nota, $id_usuario);
        if ($update->execute()) {
            header("Location: ../Notas.php");
            exit();
        } else {
            $erro = "Erro ao atualizar nota: " . $conn->error;
        }
    } else {
        $erro = "Título e conteúdo são obrigatórios.";
    }
}
include('../../includes/NavBar.php');
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

    <a href="../Notas.php" class="botao botao-voltar">⬅️ Voltar</a>
</main>
<?php include('../../includes/Footer.html'); ?>