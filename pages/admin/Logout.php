<?php
include __DIR__ . '/../../includes/RoleMiddleware.php';
roleMiddleware(['admin']);
// Destroi todas as variáveis de sessão
session_unset();

// Destroi a sessão
session_destroy();

// Redireciona o usuário de volta para a página de login do painel de admin
header('Location: admin.php');
exit();
?>
