<?php
require_once '../includes/db_connection.php';

// SUBSTITUA por um ID de usuário existente no seu banco
$id_usuario = 1;

$stmt = $conn->prepare("SELECT * FROM notas WHERE id_usuario = ? ORDER BY data_criacao DESC");
if (!$stmt) {
    die("Erro na preparação da query: " . $conn->error);
}

$stmt->bind_param("i", $id_usuario);
$stmt->execute();

$result = $stmt->get_result();
?>
<?php include('../includes/NavBar.php'); ?>
<main>
    <h2>Minhas Notas</h2>
    <a href="Nots/NewNotas.php">➕ Nova Nota</a>
    <div class="notas-container">
        <?php while ($nota = $result->fetch_assoc()): ?>
            <div class="nota">
                <h3><?= htmlspecialchars($nota['titulo']) ?></h3>
                <div class="botoes">
                    <a href="#">✏️ Editar</a>
                    <a href="#" onclick="return confirm('Tem certeza que deseja excluir esta nota?')">🗑️ Excluir</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</main>
<?php include('../includes/Footer.html'); ?>
