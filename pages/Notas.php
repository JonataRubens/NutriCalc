<?php
session_start();
require_once '../includes/db_connection.php';
// Bloqueia o acesso se não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

$stmt = $conn->prepare("SELECT * FROM notas WHERE id_usuario = ? ORDER BY data_criacao DESC");
if (!$stmt) {
    die("Erro na preparação da query: " . $conn->error);
}

$stmt->bind_param("i", $id_usuario);
$stmt->execute();

$result = $stmt->get_result();
include('../includes/NavBar.php');
?>
<link rel="stylesheet" href="/assets/css/MinhasNotas.css">

<main>
    <h2>Meus Lembretes</h2>
    <a class="nova-nota" href="Nots/NewNotas.php">➕ Nova Nota</a>
    <div class="notas-container">
        <?php while ($nota = $result->fetch_assoc()): ?>
            <div class="nota-card" onclick="openModal(`<?= htmlspecialchars($nota['titulo']) ?>`, `<?= nl2br(htmlspecialchars(substr($nota['conteudo'], 0, 100))) ?>`, `<?= nl2br(htmlspecialchars($nota['conteudo'])) ?>`, `<?= $nota['id'] ?>`)">
            <h3><?= htmlspecialchars(substr($nota['titulo'], 0, 40)) ?><?= strlen($nota['titulo']) > 40 ? '...' : '' ?></h3>
                <p><?= nl2br(htmlspecialchars(substr($nota['conteudo'], 0, 50))) ?>...</p>
                <button class="btn-ver-mais">🔍 Ver Nota</button>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<!-- Modal -->
<div id="notaModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">×</span>

        <div class="nota-actions-top">
            <a id="btnEditar" class="btn-editar">✏️ Editar</a>

            <form method="POST" action="Nots/ExcluirNotas.php" onsubmit="return confirm('Tem certeza que deseja excluir esta nota?');">
                <input type="hidden" name="id" id="notaIdParaExcluir" value="">
                <button type="submit" class="btn-excluir">🗑️ Excluir</button>
            </form>
        </div>
        <h3 id="modalTitulo"></h3>
        <p id="modalConteudo"></p>
    </div>
</div>


<script>
function openModal(titulo, resumo, completo, id) {
    document.getElementById("modalTitulo").innerText = titulo;
    document.getElementById("modalConteudo").innerHTML = completo;
    document.getElementById("notaIdParaExcluir").value = id;
    document.getElementById("btnEditar").href = `Nots/EditarNotas.php?id=${id}`;
    document.getElementById("notaModal").style.display = "block";

    
}

function closeModal() {
    document.getElementById("notaModal").style.display = "none";
}
</script>

<?php include('../includes/Footer.html'); ?>
