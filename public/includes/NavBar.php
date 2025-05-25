<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();}
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
  <link rel="stylesheet" href="/assets/css/CalcCalorias.css">
  <link rel="stylesheet" href="/assets/css/Modal.css">


  <style>

  /* Aplicar Segoe UI na navbar */
.navbar {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.navbar nav ul li a {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  display: inline-block;
  padding: 6px 12px;
  border-radius: 6px;
  transition: background-color 0.2s ease;
  text-decoration: none;
  color: inherit;
}

.navbar nav ul li a:hover {
  background-color: #f0f0f0;
}

/* Aplicar também no dropdown do usuário */
.usuario-logado {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  position: relative;
  display: inline-block;
  font-weight: 600;
  color: #333;
}

.dropdown-menu {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  position: absolute;
  top: 100%;
  right: 0;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 6px;
  min-width: 120px;
  display: none;
  z-index: 1000;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.08);
}

/* Botões de login também */
.btn-entrar,
.btn-criar {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
  </style>

</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="container">
      <nav>
        <ul>
          <li><a href="/">🏠 Página inicial</a></li>
          <li><a href="">🛠️ Ferramentas Nutricionais</a>
            <div class="submenu">
              <ul>
                <li><a href="Urls.php?page=imc">Calculadora de IMC</a></li>
                <li><a href="Urls.php?page=agua">Quantidade de Água Ideal</a></li>
                <li><a href="Urls.php?page=cal-gasto">Calculadora Gasto Calorias</a></li>
              </ul>
            </div>
          </li>
          <?php if (isset($_SESSION['usuario_nome'])): ?>
            <li><a href="">🍽️ Despensa Digital</a>
              <div class="submenu">
                <ul>
                  <li><a href="/Urls.php?page=meus-alimentos">Meus Alimentos</a></li>
                  <li><a href="/Urls.php?page=notas">Minhas Notas</a></li>
                  <li><a href="/Urls.php?page=monstro">Monstro</a></li>
                </ul>
              </div>
            </li>
          <?php endif; ?>
          <li><a href="Urls.php?page=blog">📑 Blog</a></li>
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
                <a href="#" onclick="Perfil(event)">
                  <span class="logout-icon">👤</span> Perfil
                </a>
                <!-- <a href="#" onclick="Nots(event)">
                  <span class="logout-icon">📝</span> Notas
                </a> -->
                <a href="#" onclick="logout(event)">
                  <span class="logout-icon">⏻</span> Sair
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

    <?php include __DIR__ . '/../../app/views/ModalLogin.php'; ?>
    <?php include __DIR__ . '/../../app/views/ModalRegister.php'; ?>
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
    fetch('/Urls.php?page=logout&type=user')
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

  // function Nots(event) {
  // event.preventDefault();
  // window.location.href = '/Urls.php?page=notas';
// }

function Perfil(event) {
  event.preventDefault();
  window.location.href = '/Urls.php?page=perfil';}

  </script>
