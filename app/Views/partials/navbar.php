<?php
// Navbar parcial para ser incluída nas views
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="navbar">
  <div class="container">
    <nav>
      <ul>
        <li><a href="/">🏠 Página inicial</a></li>
        <li><a href="#">🛠️ Ferramentas Nutricionais</a>
          <div class="submenu">
            <ul>
              <li><a href="/Ferramentas/Imc">Calculadora de IMC</a></li>
              <li><a href="/Ferramentas/QTDAagua">Quantidade de Água Ideal</a></li>
              <li><a href="/Ferramentas/CalcCalorias">Calculadora de Gasto Calorias</a></li>
              <li><a href="/Ferramentas/PagCalcCalorias">Calculadora de Calorias</a></li>
            </ul>
          </div>
        </li>
        <li><a href="/Blog">📑 Blog</a></li>
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
              <a href="/perfil"><span class="logout-icon">📝</span> Perfil</a>
              <a href="/Auth/logout"><span class="logout-icon">🚪</span> Sair</a>
            </div>
          </div>
        <?php else: ?>
          <a href="/Auth/login" class="btn-login">Entrar</a>
        <?php endif; ?>
      </div>
    </nav>
  </div>
</header>
<script>
function toggleDropdown() {
  var menu = document.getElementById('dropdown-menu');
  menu.classList.toggle('show');
}
</script>
