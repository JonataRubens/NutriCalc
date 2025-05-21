<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: /Urls.php?page=admin');
    exit();
}
include_once __DIR__ . '/../../../public/includes/db_connection.php';

// Definindo o número de registros por página
$registros_por_pagina = 15; 

// Calculando o número da página atual
$pagina_atual = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$inicio = ($pagina_atual - 1) * $registros_por_pagina;

// Alimentos
$pagina_alimentos = isset($_GET['p_alimentos']) ? (int)$_GET['p_alimentos'] : 1;
$inicio_alimentos = ($pagina_alimentos - 1) * $registros_por_pagina;
$sql_alimentos = "SELECT * FROM alimentos LIMIT $inicio_alimentos, $registros_por_pagina";
$alimentos = $conn->query($sql_alimentos);
$sql_total_alimentos = "SELECT COUNT(*) AS total FROM alimentos";
$result_total_alimentos = $conn->query($sql_total_alimentos);
$total_alimentos = $result_total_alimentos->fetch_assoc()['total'];
$total_paginas_alimentos = ceil($total_alimentos / $registros_por_pagina);

// Usuários
$pagina_usuarios = isset($_GET['p_usuarios']) ? (int)$_GET['p_usuarios'] : 1;
$inicio_usuarios = ($pagina_usuarios - 1) * $registros_por_pagina;
$sql_usuarios = "SELECT * FROM usuarios LIMIT $inicio_usuarios, $registros_por_pagina";
$usuarios = $conn->query($sql_usuarios);
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
        header('Location: /Urls.php?page=admin');
        exit();
    }

// Adicionando um novo usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $email = $_POST['email'];
    $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        $error = "Este e-mail já está cadastrado!";
    } else {
        // Inserir normalmente
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $sobrenome, $email, $senha);
        $stmt->execute();
    }
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
                <li><a href="/Urls.php?page=admin">Home</a></li>
                <li><a href="/">Site</a></li>
            </ul>
        </nav>

        <!-- Abas "Usuários" e "Alimentos" à direita -->
        <div class="nav-right">
            <div onclick="openTab('usuarios')">Usuários</div>
            <div onclick="openTab('alimentos')">Alimentos</div>
            <span>Bem-vindo, <?= $nome_usuario_logado ?>!</span>
            <a href="/Urls.php?page=logout-admin">Sair</a>
        </div>
    </div>
</div>

    <h1>Painel Administrativo</h1>
    <!-- Conteúdo das Abas -->
    <!-- Aba de Usuários -->
    <div id="usuarios" class="tab-content active">
        <h2 id="usuarios">Usuários Cadastrados</h2>
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
                    <a href="/Urls.php?page=admin&action=edit&tipo=user&id=<?= $user['id'] ?>" >Editar</a> |
                    <a href="/Urls.php?page=admin&action=delete&tipo=user&id=<?= $user['id'] ?>">Excluir</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <div class="pagination">
            <?php for ($i = 1; $i <= $total_paginas_usuarios; $i++) { ?>
                <a href="/Urls.php?page=admin&action=dash&p_usuarios=<?= $i ?>&tab=usuarios#usuarios"
                class="<?= ($i == $pagina_usuarios) ? 'active' : '' ?>">
                <?= $i ?>
                </a>
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
    <div id="alimentos" class="tab-content">
        <h2 id="alimentos">Alimentos Cadastrados</h2>
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
                    <a href="/Urls.php?page=admin&action=edit&tipo=food&id=<?= $alimento['id'] ?>">Editar</a> |
                    <a href="/Urls.php?page=admin&action=delete&tipo=food&id=<?= $alimento['id'] ?>">Excluir</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <div class="pagination">
            <?php for ($i = 1; $i <= $total_paginas_alimentos; $i++) { ?>
               <a href="/Urls.php?page=admin&action=dash&p_alimentos=<?= $i ?>&tab=alimentos#alimentos"
                class="<?= ($i == $pagina_alimentos) ? 'active' : '' ?>">
                <?= $i ?>
                </a>

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
            var tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });
            document.getElementById(tabName).classList.add('active');
        }

        // Ativa a aba correta ao carregar a página, conforme o parâmetro da URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            if (tab === 'alimentos') {
                openTab('alimentos');
            } else {
                openTab('usuarios');
            }
        }
</script>
</body>
</html>
