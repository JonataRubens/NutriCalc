<?php
session_start();

function roleMiddleware(array $allowedRoles) {
    // Verifica se o usuário está autenticado
    if (!isset($_SESSION['role'])) {
        // Redireciona para login se não estiver autenticado
        header('Location: /login.php');
        exit();
    }

    // Obtém o papel do usuário
    $userRole = $_SESSION['role'];

    // Verifica se o papel do usuário está entre os permitidos
    if (!in_array($userRole, $allowedRoles)) {
        // Acesso negado
        header('HTTP/1.1 403 Forbidden');
        echo "Acesso negado. Você não tem permissão para acessar esta página.";
        exit();
    }

    // Acesso permitido — o script continua normalmente
}
?>