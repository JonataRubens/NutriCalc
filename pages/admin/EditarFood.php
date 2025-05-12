<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: admin_login.php');
    exit();
}

include __DIR__ . '/../../includes/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Pega os dados do alimento para editar
    $sql = "SELECT * FROM alimentos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $alimento = $result->fetch_assoc();



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
        header('Location: admin_login.php');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $energia = $_POST['energia'];
    $proteina = $_POST['proteina'];
    $lipideos = $_POST['lipideos'];
    $carboidratos = $_POST['carboidratos'];

    // Atualiza o alimento no banco de dados
    $sql = "UPDATE alimentos SET descricao = ?, categoria = ?, energia = ?, proteina = ?, lipideos = ?, carboidratos = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssddddi", $descricao, $categoria, $energia, $proteina, $lipideos, $carboidratos, $id);
    $stmt->execute();

    header('Location: admin_dashboard.php'); // Redireciona de volta para o painel
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alimento</title>
    <link rel="stylesheet" href="../../assets/css/EditAdmin.css">
    <style>
    body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #4c6f97;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 30px auto;
        }

        form input[type="text"], form input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        form button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .navbar {
    background-color: #007bff;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Container para a navegação */
.navbar .container {
    display: flex;
    justify-content: space-between;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

/* Links "Home" e "Site" à esquerda */
.navbar .container nav {
    display: flex;
    justify-content: flex-start;
}

.navbar .container nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.navbar .container nav ul li {
    margin-right: 20px;
}

.navbar .container nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 10px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.navbar .container nav ul li a:hover {
    background-color: #0056b3;
    color: #fff;
    border-radius: 5px;
}

/* Abas "Usuários" e "Alimentos" à direita */
.navbar .container .nav-right {
    display: flex;
    align-items: center;
}

.navbar .container .nav-right span {
    color: white;
    font-size: 16px;
    padding: 10px;
}

.navbar .container .nav-right a {
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    font-size: 16px;
    margin-left: 20px;
    border-radius: 5px;
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
                <span>Bem-vindo, <?= $nome_usuario_logado ?>!</span>
                <a href="Logout.php">Sair</a> <!-- Link de Sair -->
            </div>
        </div>
    </div>

    <h1>Editar Alimento</h1>

    <form method="POST">
        <label for="descricao">Descrição</label>
        <input type="text" name="descricao" value="<?= $alimento['descricao'] ?>" required><br><br>

        <label for="categoria">Categoria</label>
        <input type="text" name="categoria" value="<?= $alimento['categoria'] ?>" required><br><br>

        <label for="energia">Energia (kcal)</label>
        <input type="number" step="0.01" name="energia" value="<?= $alimento['energia'] ?>" required><br><br>

        <label for="proteina">Proteína (g)</label>
        <input type="number" step="0.01" name="proteina" value="<?= $alimento['proteina'] ?>" required><br><br>

        <label for="lipideos">Lipídios (g)</label>
        <input type="number" step="0.01" name="lipideos" value="<?= $alimento['lipideos'] ?>" required><br><br>

        <label for="carboidratos">Carboidratos (g)</label>
        <input type="number" step="0.01" name="carboidratos" value="<?= $alimento['carboidratos'] ?>" required><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>

</body>
</html>
