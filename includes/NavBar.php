<!DOCTYPE html>
<?php
require_once 'db_connection.php';
?>

<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Blog - NutriCalc</title>
  <link rel="stylesheet" href="/assets/css/Style.css">
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="container">
      <nav>
        <ul>
          <li><a href="/index.php">Página inicial</a></li>
          <li><a href="/pages/Calculadoras.php">Ferramentas Nutricionais</a></li>
          <li><a href="/pages/Blog.php">Blog</a></li>
        </ul>
        <div class="nav-right">
          <a href="/pages/login/Login.php" class="btn-entrar">Entrar</a>
          <a href="/pages/login/Register.php" class="btn-criar">Criar Conta</a>
        </div>
      </nav>
    </div>
  </header>