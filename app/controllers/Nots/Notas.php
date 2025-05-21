<?php
// app/controllers/Nots/Notas.php
session_start();
require_once __DIR__ . '/../../../public/includes/db_connection.php';
require_once __DIR__ . '/../../models/Nota.php';

// Bloqueia o acesso se não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /');
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

// Usando o model
$notaModel = new Nota($conn);
$result = $notaModel->buscarPorUsuario($id_usuario);

include('../public/includes/NavBar.php');
?>
<link rel="stylesheet" href="/assets/css/MinhasNotas.css">

<main>
    <h2>Meus Lembretes</h2>
    <a class="nova-nota" href="/Urls.php?page=newnotas">➕ Nova Nota</a>
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

            <form method="POST" action="/Urls.php?page=excluir-notas" onsubmit="return confirm('Tem certeza que deseja excluir esta nota?');">
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
    document.getElementById("btnEditar").href = `/Urls.php?page=edit-notas&id=${id}`;
    document.getElementById("notaModal").style.display = "block";

    
}

function closeModal() {
    document.getElementById("notaModal").style.display = "none";
}
</script>

<?php include('../public/includes/Footer.html'); ?>
