<?php
echo "Running database setup scripts...\n";
echo "<br />";
include __DIR__ . '/scripts/verifica_tabela_usuarios.php';
echo "<br />";
include __DIR__ . '/scripts/verifica_tabela_alimentos.php';
echo "<br />";
include __DIR__ . '/scripts/setup_admin_user.php';
echo "<br />";
echo "\nSetup complete. For security, please delete this file after setup.";
?>
