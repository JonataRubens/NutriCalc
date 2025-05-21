<?php
session_start();
require_once __DIR__ . '/../../../public/includes/db_connection.php';
require_once __DIR__ . '/../../models/Nota.php'; // Inclui o model

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /');
    exit();
}
$id_usuario = $_SESSION['usuario_id'];

// Quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $conteudo = $_POST['conteudo'] ?? '';

    if (!empty($titulo) && !empty($conteudo)) {
        // Usando o model para criar a nota
        $notaModel = new Nota($conn);
        if ($notaModel->criar($titulo, $conteudo, $id_usuario)) {
            header("Location: /Urls.php?page=notas");
            exit();
        } else {
            $erro = "Erro ao salvar a nota.";
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
    <body>
        <h2>Criar Nova Nota</h2>
        <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

        <form method="POST" action="">
            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" maxlength="75" id="titulo" required><br><br>

            <label for="conteudo">Conteúdo:</label><br>
            <textarea name="conteudo" id="conteudo" maxlength="500" rows="5" required></textarea><br><br>

            <button type="submit" class="botao botao-salvar">✔ Salvar Nota</button>
            
        </form>
        <a href="/Urls.php?page=notas" class="botao botao-voltar">⬅️ Voltar</a>

        
    </body>
</main>
<?php include('../public/includes/Footer.html'); ?>
