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
    case 'calculadora-calorias':
        require_once '../app/controllers/Ferramentas/PagCalcCalorias.php';
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
        require_once '../app/controllers/admin/admin.php';
        break;
    








    default:
        echo "Página não encontrada";
        break;
}
