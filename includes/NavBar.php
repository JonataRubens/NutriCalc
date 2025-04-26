<?php
// Começa o PHP antes de qualquer HTML
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db_connection.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Blog - NutriCalc</title>
  <link rel="stylesheet" href="/assets/css/Style.css">
  <link rel="stylesheet" href="/assets/css/User.css">
  <link rel="stylesheet" href="assets/css/BarraDePesquisa.css">
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="container">
      <nav>
        <ul>
          <li><a href="/index.php">Página inicial</a></li>
          <li><a href="">Ferramentas Nutricionais</a>
          <div class="submenu">
          <ul>
            <li><a href="/pages/Ferramentas/Imc.php">Calculadora de IMC</a></li>
            <li><a href="/pages/Ferramentas/QTDAagua.php">Quantidade de Água Ideal</a></li>
            <li><a href="/pages/Ferramentas/CalcCalorias.php">Calculadora de Calorias</a></li>
          </ul>
        </div>
        </li>
          <li><a href="/pages/Blog.php">Blog</a></li>
        </ul>
        <div class="nav-right">
          <?php if (isset($_SESSION['usuario_nome'])): ?>
            <div class="usuario-logado">
              <div class="usuario-info" onclick="toggleDropdown()">
                <span class="bolinha-verde"></span>
                <?= htmlspecialchars($_SESSION['usuario_nome']) ?>
                <span class="seta">&#9662;</span>
              </div>
              <div id="dropdown-menu" class="dropdown-menu">
                  <a href="#" onclick="logout(event)">
                    <span class="logout-icon">⎋</span> Sair
                  </a>
                </a>
              </div>
            </div>
          <?php else: ?>
            <a href="/pages/login/Login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="btn-entrar">Entrar</a>
            <a href="/pages/login/Register.php" class="btn-criar">Criar Conta</a>
          <?php endif; ?>
        </div>
      </nav>
    </div>
  </header>

  <script>
    function toggleDropdown() {
      const menu = document.getElementById('dropdown-menu');
      menu.classList.toggle('ativo');
    }

    window.addEventListener('click', function (e) {
      if (!e.target.closest('.usuario-logado')) {
        document.getElementById('dropdown-menu')?.classList.remove('ativo');
      }
    });


    function logout(e) {
    e.preventDefault();
    fetch('/pages/login/Logout.php')
      .then(response => {
        if (response.ok) {
          // Atualiza a página para refletir o logout (ex: troca nav bar)
          location.reload();
        }
      })
      .catch(error => {
        console.error('Erro ao fazer logout:', error);
      });
  }
  </script>
