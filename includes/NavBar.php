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
  <link rel="stylesheet" href="/NutriCalc/assets/css/Style.css">
  <link rel="stylesheet" href="/NutriCalc/assets/css/User.css">
  <link rel="stylesheet" href="/NutriCalc/assets/css/BarraDePesquisa.css">
  <link rel="stylesheet" href="/NutriCalc/assets/css/CalcCalorias.css">
  <link rel="stylesheet" href="/NutriCalc/assets/css/Modal.css">


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
            <li><a href="/pages/Ferramentas/CalcCalorias.php">Calculadora de Gasto Calorias</a></li>
            <li><a href="/pages/Ferramentas/PagCalcCalorias.php">Calculadora de Calorias</a></li>
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
                  <?php if (isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'admin'): ?>
                      <a href="/NutriCalc/pages/admin/admin.php">
                        <span class="admin-icon">🛠️</span> Painel
                      </a>
                  <?php endif; ?>
                  <a href="#" onclick="logout(event)">
                    <span class="logout-icon">⎋</span> Sair
                  </a>
              </div>
            </div>
          <?php else: ?>
            <a href="javascript:void(0);" onclick="openLoginModal()" class="btn-entrar">Entrar</a>
            <a href="javascript:void(0);" onclick="openRegisterModal()" class="btn-criar">Criar Conta</a>
          <?php endif; ?>
        </div>
      </nav>
    </div>

    <?php include('ModalLogin.php'); ?>
    <?php include('ModalRegister.php'); ?>

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
    fetch('/NutriCalc/pages/login/Logout.php')
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
