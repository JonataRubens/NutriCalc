<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: Login.php");
    exit;
}

echo "<h1>Bem-vindo, " . htmlspecialchars($_SESSION['usuario_nome']) . "!</h1>";
echo "<a href='logout.php'>Sair</a>";
