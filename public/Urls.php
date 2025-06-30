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
if ($page == 'chatbot') {
    require_once '../app/controllers/chatbot/ChatbotController.php';
    exit; // Importante para parar a execução após processar o AJAX
}




switch ($page) {
    
    case 'imc':
        require_once '../app/views/Ferramentas/Imc.php';
        break;
    case 'agua':
        require_once '../app/views/Ferramentas/QTDAagua.php';
        break;
    case 'cal-gasto':
        require_once '../app/views/Ferramentas/CalcCalorias.php';
        break;
    
    case 'blog':
        require_once '../app/views/posts/Blog.php';
        break;

    case 'monstro':
        require_once '../app/views/Ferramentas/Monstro.php';
        break;
    
    case 'notas':
        require_once '../app/views/notas/Notas.php';
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
    case 'ranking':
        require_once '../app/views/ranking/Ranking.php';
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
            require_once '../app/views/admin/Dashboard.php';
        } elseif ($action === 'edit' && $tipo && $id) {
            if (session_status() == PHP_SESSION_NONE) session_start();
            if (!isset($_SESSION['user_id'])) {
                header('Location: /Urls.php?page=admin');
                exit();
            }
            if ($tipo === 'user') {
                require_once '../app/controllers/admin/EditarUser.php';
            } elseif ($tipo === 'food') {
                require_once '../app/controllers/admin/EditarFood.php';
            }
        } elseif ($action === 'delete' && $tipo && $id) {
            if (session_status() == PHP_SESSION_NONE) session_start();
            if (!isset($_SESSION['user_id'])) {
                header('Location: /Urls.php?page=admin');
                exit();
            }
            if ($tipo === 'user') {
                require_once '../app/controllers/admin/DelUser.php';
            } elseif ($tipo === 'food') {
                require_once '../app/controllers/admin/DelFood.php';
            }
        } else {
            require_once '../app/views/admin/admin.php';
        }
        break;


    case 'logout-admin':
        require_once '../app/views/admin/LogoutAdmin.php';
        break;

    case 'post-calorias':
        require_once '../app/views/posts/posts/PostCalorias.php';
        break;
    case 'post-imc':
        require_once '../app/views/posts/posts/PostIMC.php';
        break;
    case 'post-agua':
        require_once '../app/views/posts/posts/PostQTDAgua.php';
        break;
    case 'post-gasto-calorico':
        require_once '../app/views/posts/posts/GastoCalorico.php';
        break;

 case 'alimentospdf':
        require_once '../scripts/dompdf/Alimentospdf.php';
        break;

    case 'PDF':
        require_once '../scripts/dompdf/Geradorpdf.php';
        break;

    case 'autoload':
        require_once '../scripts/dompdf/vendor/autoload.php';
        break;

    case 'lista-substituicao': // NOVO CASE AQUI
        require_once '../app/views/meusAlimentos/Substituicao.php';
        break;


    case 'meus-alimentos':
        require_once '../app/views/meusAlimentos/Alimentos.php';
        break;

    case 'api':
        require_once '../public/api/Alimentos.php';
        break;

    case 'contato':
        require_once '../app/views/email/Email.php';
        break;

    case 'comparador':
        require_once '../app/views/comparador/Comparador.php';
        break;

    case 'landing':
        require_once 'assets/LandingPage.html';
        break;
        
    default:
        echo "Página não encontrada";
        break;
}
