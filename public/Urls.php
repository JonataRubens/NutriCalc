<?php
$page = $_GET['page'] ?? '';


if ($page == 'login') {
    require_once '../app/controllers/login/LoginAjax.php';
    exit; // Importante para parar a execução após processar o AJAX
}

if ($page == 'logout') {
    require_once '../app/controllers/login/Logout.php';
    exit; // Importante para parar a execução após processar o AJAX
}

if ($page == 'register') {
    require_once '../app/controllers/login/RegisterAjax.php';
    exit; // Importante para parar a execução após processar o AJAX
}

switch ($page) {
    case 'meus-alimentos':
        require_once '../app/controllers/Ferramentas/MeusAlimentos.php';
        break;
    case 'imc':
        require_once '../app/controllers/Ferramentas/Imc.php';
        break;
    case 'agua':
        require_once '../app/controllers/Ferramentas/QTDAagua.php';
        break;
    case 'cal-gasto':
        require_once '../app/controllers/Ferramentas/CalcCalorias.php';
        break;
    case 'blog':
        require_once '../app/controllers/posts/Blog.php';
        break;
    case 'monstro':
        require_once '../app/controllers/Ferramentas/Monstro.php';
        break;
    
    case 'notas':
        require_once '../app/controllers/Nots/Notas.php';
        break;

    case 'newnotas':
        require_once '../app/controllers/Nots/NewNotas.php';
        break;

    case 'edit-notas':
        require_once '../app/controllers/Nots/EditarNotas.php';
        break;

    case 'excluir-notas':
        require_once '../app/controllers/Nots/ExcluirNotas.php';
        break;

    case 'perfil':
        require_once '../app/controllers/perfil/Perfil.php';
        break;

    case 'admin':
        $action = $_GET['action'] ?? '';
        $tipo = $_GET['tipo'] ?? ''; // tipo pode ser 'user' ou 'food'
        $id = $_GET['id'] ?? null;

        if ($action === 'dash') {
            if (session_status() == PHP_SESSION_NONE) session_start();
            if (!isset($_SESSION['user_id'])) {
                header('Location: /Urls.php?page=admin');
                exit();
            }
            require_once '../app/pages/admin/Dashboard.php';
        } elseif ($action === 'edit' && $tipo && $id) {
            if (session_status() == PHP_SESSION_NONE) session_start();
            if (!isset($_SESSION['user_id'])) {
                header('Location: /Urls.php?page=admin');
                exit();
            }
            if ($tipo === 'user') {
                require_once '../app/pages/admin/EditarUser.php';
            } elseif ($tipo === 'food') {
                require_once '../app/pages/admin/EditarFood.php';
            }
        } elseif ($action === 'delete' && $tipo && $id) {
            if (session_status() == PHP_SESSION_NONE) session_start();
            if (!isset($_SESSION['user_id'])) {
                header('Location: /Urls.php?page=admin');
                exit();
            }
            if ($tipo === 'user') {
                require_once '../app/pages/admin/DelUser.php';
            } elseif ($tipo === 'food') {
                require_once '../app/pages/admin/DelFood.php';
            }
        } else {
            require_once '../app/pages/admin/admin.php';
        }
        break;


    case 'logout-admin':
        require_once '../app/pages/admin/LogoutAdmin.php';
        break;

    case 'post-calorias':
        require_once '../app/controllers/posts/posts/PostCalorias.php';
        break;
    case 'post-imc':
        require_once '../app/controllers/posts/posts/PostIMC.php';
        break;
    case 'post-agua':
        require_once '../app/controllers/posts/posts/PostQTDAgua.php';
        break;
    case 'post-gasto-calorico':
        require_once '../app/controllers/posts/posts/GastoCalorico.php';
        break;


    default:
        echo "Página não encontrada";
        break;
}
