<?php
session_start();
require_once __DIR__ . '/../../includes/db_connection.php';

if (!isset($_SESSION['usuario_nome']) || !isset($_SESSION['usuario_role']) || $_SESSION['usuario_role'] !== 'admin') {
    header("Location: /NutriCalc/index.php");
    exit;
}

// Handle CRUD operations for alimentos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $descricao = trim($_POST['descricao']);
                $categoria = trim($_POST['categoria']);
                $energia = floatval($_POST['energia']);
                $proteina = floatval($_POST['proteina']);
                $lipideos = floatval($_POST['lipideos']);
                $carboidratos = floatval($_POST['carboidratos']);

                $stmt = $conn->prepare("INSERT INTO alimentos (descricao, categoria, energia, proteina, lipideos, carboidratos) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssdddd", $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos);
                if ($stmt->execute()) {
                    $message = "Alimento criado com sucesso.";
                } else {
                    $message = "Erro ao criar alimento: " . $conn->error;
                }
                break;

            case 'update':
                $id = intval($_POST['id']);
                $descricao = trim($_POST['descricao']);
                $categoria = trim($_POST['categoria']);
                $energia = floatval($_POST['energia']);
                $proteina = floatval($_POST['proteina']);
                $lipideos = floatval($_POST['lipideos']);
                $carboidratos = floatval($_POST['carboidratos']);

                $stmt = $conn->prepare("UPDATE alimentos SET descricao = ?, categoria = ?, energia = ?, proteina = ?, lipideos = ?, carboidratos = ? WHERE id = ?");
                $stmt->bind_param("ssddddi", $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos, $id);
                if ($stmt->execute()) {
                    $message = "Alimento atualizado com sucesso.";
                } else {
                    $message = "Erro ao atualizar alimento: " . $conn->error;
                }
                break;

            case 'delete':
                $id = intval($_POST['id']);
                $stmt = $conn->prepare("DELETE FROM alimentos WHERE id = ?");
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    $message = "Alimento deletado com sucesso.";
                } else {
                    $message = "Erro ao deletar alimento: " . $conn->error;
                }
                break;

            case 'reset_password':
                $admin_id = $_SESSION['usuario_id'];
                $new_password = trim($_POST['new_password']);
                if (strlen($new_password) < 8) {
                    $message = "A nova senha deve ter pelo menos 8 caracteres.";
                } else {
                    $senhaHash = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ? AND role = 'admin'");
                    $stmt->bind_param("si", $senhaHash, $admin_id);
                    if ($stmt->execute()) {
                        $message = "Senha do admin atualizada com sucesso.";
                    } else {
                        $message = "Erro ao atualizar senha: " . $conn->error;
                    }
                }
                break;
        }
    }
}

// Fetch all alimentos for display
$result = $conn->query("SELECT * FROM alimentos");
$alimentos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin - NutriCalc</title>
    <link rel="stylesheet" href="/NutriCalc/assets/css/Style.css">
</head>
<body>
    <?php include(__DIR__ . '/../../includes/NavBar.php'); ?>
    <main class="container" style="padding: 30px 0;">
        <h1>Painel de Administração</h1>
        <?php if (isset($message)): ?>
            <p style="background-color: #f0fff4; color: #2f855a; padding: 10px; border-radius: 5px; margin: 15px 0;"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <section style="margin-bottom: 40px;">
            <h2>Gerenciar Alimentos</h2>
            <button onclick="openCreateModal()" class="btn-criar" style="margin-top: 10px;">Criar Novo Alimento</button>
        </section>

        <?php include(__DIR__ . '/CriarAlimentoModal.php'); ?>

        <section style="margin-bottom: 40px;">
            <h3>Lista de Alimentos</h3>
            <?php if (count($alimentos) > 0): ?>
                <table class="results-table" style="width: 100%; border-spacing: 0; margin-top: 15px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Energia (kcal)</th>
                        <th>Proteína (g)</th>
                        <th>Lipídios (g)</th>
                        <th>Carboidratos (g)</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alimentos as $alimento): ?>
                        <tr>
                            <td><?php echo $alimento['id']; ?></td>
                            <td><?php echo htmlspecialchars($alimento['descricao']); ?></td>
                            <td><?php echo htmlspecialchars($alimento['categoria']); ?></td>
                            <td><?php echo $alimento['energia']; ?></td>
                            <td><?php echo $alimento['proteina']; ?></td>
                            <td><?php echo $alimento['lipideos']; ?></td>
                            <td><?php echo $alimento['carboidratos']; ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $alimento['id']; ?>">
                                    <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este alimento?')">Deletar</button>
                                </form>
                                <button onclick="editAlimento(<?php echo $alimento['id']; ?>, '<?php echo addslashes($alimento['descricao']); ?>', '<?php echo addslashes($alimento['categoria']); ?>', <?php echo $alimento['energia']; ?>, <?php echo $alimento['proteina']; ?>, <?php echo $alimento['lipideos']; ?>, <?php echo $alimento['carboidratos']; ?>)">Editar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p style="margin-top: 10px;">Nenhum alimento encontrado.</p>
            <?php endif; ?>
        </section>

        <section style="margin-bottom: 40px;">
            <h3>Editar Alimento</h3>
            <form method="POST" id="editForm" style="display:none; margin-top: 15px;">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" id="edit_id">
            <div class="form-group">
                <label for="edit_descricao">Descrição</label>
                <input type="text" id="edit_descricao" name="descricao" required>
            </div>
            <div class="form-group">
                <label for="edit_categoria">Categoria</label>
                <input type="text" id="edit_categoria" name="categoria" required>
            </div>
            <div class="form-group">
                <label for="edit_energia">Energia (kcal)</label>
                <input type="number" id="edit_energia" name="energia" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="edit_proteina">Proteína (g)</label>
                <input type="number" id="edit_proteina" name="proteina" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="edit_lipideos">Lipídios (g)</label>
                <input type="number" id="edit_lipideos" name="lipideos" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="edit_carboidratos">Carboidratos (g)</label>
                <input type="number" id="edit_carboidratos" name="carboidratos" step="0.01" required>
            </div>
            <button type="submit">Atualizar</button>
        </form>

        <section style="margin-bottom: 40px;">
            <h2>Resetar Senha do Admin</h2>
            <form method="POST" style="margin-top: 15px;">
            <input type="hidden" name="action" value="reset_password">
            <div class="form-group">
                <label for="new_password">Nova Senha</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <button type="submit">Resetar Senha</button>
        </form>
    </main>

    <?php include(__DIR__ . '/../../includes/Footer.html'); ?>

    <script>
        function editAlimento(id, descricao, categoria, energia, proteina, lipideos, carboidratos) {
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_descricao').value = descricao;
            document.getElementById('edit_categoria').value = categoria;
            document.getElementById('edit_energia').value = energia;
            document.getElementById('edit_proteina').value = proteina;
            document.getElementById('edit_lipideos').value = lipideos;
            document.getElementById('edit_carboidratos').value = carboidratos;
        }

        function openCreateModal() {
            document.getElementById('createAlimentoModal').style.display = 'block';
        }

        function closeCreateModal() {
            document.getElementById('createAlimentoModal').style.display = 'none';
        }

        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('createAlimentoModal')) {
                closeCreateModal();
            }
        });
    </script>
</body>
</html>
