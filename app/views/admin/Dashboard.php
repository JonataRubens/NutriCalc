<?php
// Definir o caminho base do projeto
define('BASE_PATH', realpath(__DIR__ . '/../../../'));

// Incluir o model usando caminho absoluto
require_once BASE_PATH . '/app/models/DashBoardAdmin.php';
require_once BASE_PATH . '/public/includes/db_connection.php';

$dashboardModel = new DashboardModel($conn);

// Verificar sessão e obter dados do usuário
$user_id = $dashboardModel->verificarSessao();
$nome_usuario_logado = $dashboardModel->getNomeUsuarioLogado($user_id);

// Processar paginação
$pagina_usuarios = isset($_GET['p_usuarios']) ? (int)$_GET['p_usuarios'] : 1;
$pagina_alimentos = isset($_GET['p_alimentos']) ? (int)$_GET['p_alimentos'] : 1;

// Obter dados
$usuarios = $dashboardModel->getUsuarios($pagina_usuarios);
$alimentos = $dashboardModel->getAlimentos($pagina_alimentos);
$total_paginas_usuarios = $dashboardModel->getTotalPaginasUsuarios();
$total_paginas_alimentos = $dashboardModel->getTotalPaginasAlimentos();

// Processar formulários
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        $resultado = $dashboardModel->adicionarUsuario(
            $_POST['nome'],
            $_POST['sobrenome'], 
            $_POST['email'],
            $_POST['senha']
        );
        $message = $resultado['message'];
        $message_type = $resultado['success'] ? 'success' : 'error';
    }
    
    if (isset($_POST['add_food'])) {
        $resultado = $dashboardModel->adicionarAlimento(
            $_POST['descricao'],
            $_POST['categoria'],
            $_POST['energia'],
            $_POST['proteina'],
            $_POST['lipideos'],
            $_POST['carboidratos']
        );
        $message = $resultado['message'];
        $message_type = $resultado['success'] ? 'success' : 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../../assets/css/Admin.css">
    <link rel="stylesheet" href="../../assets/css/EditAdmin.css">
</head>
<body>

<!-- Mini Navbar -->
<div class="navbar">
    <div class="container">
        <nav>
            <ul>
                <li><a href="/Urls.php?page=admin">Home</a></li>
                <li><a href="/">Site</a></li>
            </ul>
        </nav>

        <div class="nav-right">
            <div onclick="openTab('usuarios')">Usuários</div>
            <div onclick="openTab('alimentos')">Alimentos</div>
            <span>Bem-vindo, <?= htmlspecialchars($nome_usuario_logado) ?>!</span>
            <a href="/Urls.php?page=logout-admin" style="color:rgb(255, 255, 255);">Sair</a>
        </div>
    </div>
</div>

<h1>Painel Administrativo</h1>

<?php if (!empty($message)): ?>
    <div class="message <?= $message_type ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<!-- Aba de Usuários -->
<div id="usuarios" class="tab-content active">
    <h2>Usuários Cadastrados</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php while ($user = $usuarios->fetch_assoc()): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['nome'] . ' ' . $user['sobrenome']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <a href="/Urls.php?page=admin&action=edit&tipo=user&id=<?= $user['id'] ?>">Editar</a> |
                <a href="/Urls.php?page=admin&action=delete&tipo=user&id=<?= $user['id'] ?>" 
                   onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_paginas_usuarios; $i++): ?>
            <a href="/Urls.php?page=admin&action=dash&p_usuarios=<?= $i ?>&tab=usuarios#usuarios"
               class="<?= ($i == $pagina_usuarios) ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

    <h2>Adicionar Novo Usuário</h2>
    <form method="POST">
        <label for="nome">Nome</label>
        <input type="text" name="nome" required><br><br>

        <label for="sobrenome">Sobrenome</label>
        <input type="text" name="sobrenome" required><br><br>

        <label for="email">Email</label>
        <input type="email" name="email" required><br><br>

        <label for="senha">Senha</label>
        <input type="password" name="senha" required><br><br>

        <button type="submit" name="add_user">Adicionar Usuário</button>
    </form>
</div>

<!-- Aba de Alimentos -->
<div id="alimentos" class="tab-content">
    <h2>Alimentos Cadastrados</h2>
    <table border="1">
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
        <?php while ($alimento = $alimentos->fetch_assoc()): ?>
        <tr>
            <td><?= $alimento['id'] ?></td>
            <td><?= htmlspecialchars($alimento['descricao']) ?></td>
            <td><?= htmlspecialchars($alimento['categoria']) ?></td>
            <td><?= $alimento['energia'] ?></td>
            <td><?= $alimento['proteina'] ?></td>
            <td><?= $alimento['lipideos'] ?></td>
            <td><?= $alimento['carboidratos'] ?></td>
            <td>
                <a href="/Urls.php?page=admin&action=edit&tipo=food&id=<?= $alimento['id'] ?>">Editar</a> |
                <a href="/Urls.php?page=admin&action=delete&tipo=food&id=<?= $alimento['id'] ?>"
                   onclick="return confirm('Tem certeza que deseja excluir este alimento?')">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_paginas_alimentos; $i++): ?>
           <a href="/Urls.php?page=admin&action=dash&p_alimentos=<?= $i ?>&tab=alimentos#alimentos"
              class="<?= ($i == $pagina_alimentos) ? 'active' : '' ?>">
              <?= $i ?>
           </a>
        <?php endfor; ?>
    </div>

    <h2>Adicionar Novo Alimento</h2>
    <form method="POST">
        <label for="descricao">Descrição</label>
        <input type="text" name="descricao" required><br><br>

        <label for="categoria">Categoria</label>
        <input type="text" name="categoria" required><br><br>

        <label for="energia">Energia (kcal)</label>
        <input type="number" step="0.01" name="energia" required><br><br>

        <label for="proteina">Proteína (g)</label>
        <input type="number" step="0.01" name="proteina" required><br><br>

        <label for="lipideos">Lipídios (g)</label>
        <input type="number" step="0.01" name="lipideos" required><br><br>

        <label for="carboidratos">Carboidratos (g)</label>
        <input type="number" step="0.01" name="carboidratos" required><br><br>

        <button type="submit" name="add_food">Adicionar Alimento</button>
    </form>
</div>

<script src="/assets/js/DashBoard.js"></script>

</body>
</html>
