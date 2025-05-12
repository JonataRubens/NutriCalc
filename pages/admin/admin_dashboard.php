<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: admin.php');
    exit();
}

include __DIR__ . '/../../includes/db_connection.php';

// Definindo o número de registros por página
$registros_por_pagina = 10; 

// Calculando o número da página atual
$pagina_atual = isset($_GET['page']) ? $_GET['page'] : 1;
$inicio = ($pagina_atual - 1) * $registros_por_pagina;

// Consultando os alimentos com paginação
$sql_alimentos = "SELECT * FROM alimentos LIMIT $inicio, $registros_por_pagina";
$alimentos = $conn->query($sql_alimentos);

// Consultando o total de alimentos para calcular o número de páginas
$sql_total_alimentos = "SELECT COUNT(*) AS total FROM alimentos";
$result_total_alimentos = $conn->query($sql_total_alimentos);
$total_alimentos = $result_total_alimentos->fetch_assoc()['total'];
$total_paginas = ceil($total_alimentos / $registros_por_pagina);

// Consultando os usuários com paginação
$sql_usuarios = "SELECT * FROM usuarios LIMIT $inicio, $registros_por_pagina";
$usuarios = $conn->query($sql_usuarios);

// Consultando o total de usuários para calcular o número de páginas
$sql_total_usuarios = "SELECT COUNT(*) AS total FROM usuarios";
$result_total_usuarios = $conn->query($sql_total_usuarios);
$total_usuarios = $result_total_usuarios->fetch_assoc()['total'];
$total_paginas_usuarios = ceil($total_usuarios / $registros_por_pagina);

    $user_id = $_SESSION['user_id'];
    $sql_user = "SELECT nome FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql_user);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();


    // Verificar se o usuário foi encontrado
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $nome_usuario_logado = $user_data['nome'];
    } else {
        // Se o usuário não for encontrado, redireciona para a página de login
        header('Location: admin.php');
        exit();
    }

// Adicionando um novo usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Criptografando a senha

    $sql = "INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $sobrenome, $email, $senha);
    $stmt->execute();
}
// Adicionando um novo alimento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_food'])) {
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $energia = $_POST['energia'];
    $proteina = $_POST['proteina'];
    $lipideos = $_POST['lipideos'];
    $carboidratos = $_POST['carboidratos'];

    // Verificando se todos os campos foram preenchidos
    if (empty($descricao) || empty($categoria) || empty($energia) || empty($proteina) || empty($lipideos) || empty($carboidratos)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Inserir o alimento no banco de dados
        $sql = "INSERT INTO alimentos (descricao, categoria, energia, proteina, lipideos, carboidratos) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdddd", $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos);
        if ($stmt->execute()) {
        } else {
            echo "Erro ao adicionar alimento: " . $conn->error;
        }
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
    <style>
        .navbar .container .nav-right a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
            margin-left: 20px;
            border-radius: 5px;
            background-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .navbar .container .nav-right a:hover {
            background-color: #0056b3;
            color: white;
        }

    </style>
</head>
<body>

<!-- Mini Navbar -->
<div class="navbar">
    <div class="container">
        <!-- Links "Home" e "Site" à esquerda -->
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="/index.php">Site</a></li>
            </ul>
        </nav>

        <!-- Abas "Usuários" e "Alimentos" à direita -->
        <div class="nav-right">
            <div onclick="openTab('usuarios')">Usuários</div>
            <div onclick="openTab('alimentos')">Alimentos</div>
            <span>Bem-vindo, <?= $nome_usuario_logado ?>!</span>
            <a href="Logout.php">Sair</a>
        </div>
    </div>
</div>

    <h1>Painel Administrativo</h1>
    <!-- Conteúdo das Abas -->
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
            <?php while ($user = $usuarios->fetch_assoc()) { ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['nome'] . ' ' . $user['sobrenome'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <a href="EditarUser.php?id=<?= $user['id'] ?>">Editar</a> |
                    <a href="DelUser.php?id=<?= $user['id'] ?>">Excluir</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <div class="pagination">
            <!-- Paginador de Usuários -->
            <?php for ($i = 1; $i <= $total_paginas_usuarios; $i++) { ?>
                <a href="?page=<?= $i ?>" class="<?= ($i == $pagina_atual) ? 'active' : '' ?>"><?= $i ?></a>
            <?php } ?>
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
            <?php while ($alimento = $alimentos->fetch_assoc()) { ?>
            <tr>
                <td><?= $alimento['id'] ?></td>
                <td><?= $alimento['descricao'] ?></td>
                <td><?= $alimento['categoria'] ?></td>
                <td><?= $alimento['energia'] ?></td>
                <td><?= $alimento['proteina'] ?></td>
                <td><?= $alimento['lipideos'] ?></td>
                <td><?= $alimento['carboidratos'] ?></td>
                <td>
                    <a href="EditarFood.php?id=<?= $alimento['id'] ?>">Editar</a> |
                    <a href="DelFood.php?id=<?= $alimento['id'] ?>">Excluir</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <div class="pagination">
            <!-- Paginador de Alimentos -->
            <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                <a href="?page=<?= $i ?>" class="<?= ($i == $pagina_atual) ? 'active' : '' ?>"><?= $i ?></a>
            <?php } ?>
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

     <script>
        function openTab(tabName) {
            // Esconde todas as abas
            var tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });

            // Mostra a aba que foi clicada
            document.getElementById(tabName).classList.add('active');
        }
    </script>
</body>
</html>
