<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = dirname($_SERVER['SCRIPT_NAME']);
$path = '/' . trim(str_replace($base, '', $uri), '/');


if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'cal-gasto':
            require __DIR__ . '/../app/views/Ferramentas/CalcCalorias.php';
            break;
        case 'imc':
            require __DIR__ . '/../app/views/Ferramentas/Imc.php';
            break;
        case 'agua':
            require __DIR__ . '/../app/views/Ferramentas/QTDAagua.php';
            break;
        case 'blog':
            require __DIR__ . '/../app/views/posts/Blog.php';
            break;
        case 'monstro':
            require __DIR__ . '/../app/views/Ferramentas/Monstro.php';
            break;
        case 'notas':
            require __DIR__ . '/../app/views/notas/Notas.php';
            break;
        case 'newnotas':
            require __DIR__ . '/../app/controllers/Nots/NewNotas.php';
            break;
        case 'edit-notas':
            require __DIR__ . '/../app/controllers/Nots/EditarNotas.php';
            break;
        case 'excluir-notas':
            require __DIR__ . '/../app/controllers/Nots/ExcluirNotas.php';
            break;
        case 'perfil':
            require __DIR__ . '/../app/controllers/perfil/Perfil.php';
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
        case 'meus-alimentos':
            require_once '../app/views/meusAlimentos/Alimentos.php';
            break;

        case 'alimentos-api':
            require_once '../app/api/alimentos/Alimentos.php';
            break;
        case 'usuarios-api':
            require_once '../app/api/usuarios/usuarios.php';
            break;
        default:
            http_response_code(404);
            echo 'Página não encontrada';
            break;
    }
    exit;
}

// Página inicial padrão
require __DIR__ . '/index.php';
