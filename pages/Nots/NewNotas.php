<?php
session_start();
require_once '../../includes/db_connection.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit();
}
$id_usuario = $_SESSION['usuario_id'];

// Quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $conteudo = $_POST['conteudo'] ?? '';

    if (!empty($titulo) && !empty($conteudo)) {
        $stmt = $conn->prepare("INSERT INTO notas (id_usuario, titulo, conteudo) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id_usuario, $titulo, $conteudo);

        if ($stmt->execute()) {
            header("Location: ../Notas.php");
            exit();
        } else {
            $erro = "Erro ao salvar a nota: " . $conn->error;
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
    <body>
        <h2>Criar Nova Nota</h2>
        <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

        <form method="POST" action="">
            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" maxlength="75" id="titulo" required><br><br>

            <label for="conteudo">Conteúdo:</label><br>
            <textarea name="conteudo" id="conteudo" maxlength="500" rows="5" required></textarea><br><br>

            <button type="submit" class="botao botao-salvar">💾 Salvar Nota</button>
            
        </form>
        <a href="../Notas.php" class="botao botao-voltar">⬅️ Voltar</a>

        
    </body>
</main>
<?php include('../../includes/Footer.html'); ?>
