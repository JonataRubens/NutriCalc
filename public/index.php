<?php
session_start();
$isLoggedIn = isset($_SESSION['usuario_nome']); // Ajustado conforme sua lógica de login
?>

<?php include('includes/NavBar.php'); ?>
<link rel="stylesheet" href="/assets/css/Chatbot.css">
<link rel="stylesheet" href="/assets/css/pop.css">
<script src="/assets/js/chatbot.js" defer></script>

<?php if (!$isLoggedIn): ?>
  <!-- POPUP DE CADASTRO/LOGIN COM OVERLAY -->
  <div id="popup-overlay">
    <div id="popup-box">
      <h2>Bem-vindo!</h2>
      <p>Cadastre-se ou entre na sua conta para aproveitar todos os recursos da plataforma!</p>
      <div class="popup-buttons">
        <a href="javascript:void(0);" onclick="abrirCadastro()" class="btn-cadastro">Criar conta</a>
        <a href="javascript:void(0);" onclick="abrirLogin()" class="btn-login">Entrar</a>
      </div>
      <button id="fechar-popup" style="display: none;">Fechar</button>
    </div>
  </div>
<?php endif; ?>

<!-- Conteúdo principal -->
<main class="container">
  <section class="hero">
    <h1>Tabela Nutricional</h1>
    <p>Plataforma nutricional completa, fornecendo informações detalhadas sobre alimentos e ferramentas de apoio para uso pessoal.</p>

    <input type="text" id="searchInput" placeholder="🔍 Pesquisar alimento..." class="search-input">
    <div id="searchResults" class="search-results"></div>
  </section>

  <section class="grupos">
    <h3>Grupos alimentares</h3>
    <div class="grid-grupos">
      <button onclick="searchByCategory('Bebidas')">Bebidas</button>
      <button onclick="searchByCategory('Carnes')">Carnes</button>
      <button onclick="searchByCategory('Cereais')">Cereais</button>
      <button onclick="searchByCategory('Frutas')">Frutas</button>
    </div>
  </section>

  <hr class="linha-divisoria">
  <section class="conheca">
    <h3>Nossas Principais Ferramentas Nutricionais</h3>
    <div class="cards-simples">
      <a href="/Urls.php?page=cal-gasto" class="card">Calculadora de Calorias</a>
      <a href="/Urls.php?page=imc" class="card">Calculadora de IMC e Peso Ideal</a>
      <a href="/Urls.php?page=agua" class="card card-agua">Quantidade de Água Ideal</a>
    </div>
  </section>
</main>

<script src="/assets/js/Index.js"></script>
<?php include __DIR__ . '/../app/views/Chatbot.php'; ?>
<?php include('includes/Footer.html'); ?>

<!-- Script do popup -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("popup-overlay");
    const fecharBtn = document.getElementById("fechar-popup");

    if (popup && fecharBtn) {
      // Mostra o botão fechar após 10 segundos
      setTimeout(() => {
        fecharBtn.style.display = "inline-block";
      }, 10000);

      fecharBtn.addEventListener("click", () => {
        popup.style.display = "none";
      });
    }
  });

  function abrirCadastro() {
    openRegisterModal(); // função já existente
    esconderPopup();
  }

  function abrirLogin() {
    openLoginModal(); // função já existente
    esconderPopup();
  }

  function esconderPopup() {
    const popup = document.getElementById("popup-overlay");
    if (popup) {
      popup.style.display = "none";
    }
  }
</script>
