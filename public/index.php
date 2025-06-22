<?php session_start(); ?>
<?php
$isLoggedIn = isset($_SESSION['usuario_nome']);

$imgDir = __DIR__ . '/assets/img/popup/';
$imgUrlBase = '/assets/img/popup/';
$images = glob($imgDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
$randomImg = '';
if ($images && count($images) > 0) {
    $randomImg = $imgUrlBase . basename($images[array_rand($images)]);
}
?>

<?php include('includes/NavBar.php'); ?>
<link rel="stylesheet" href="/assets/css/Chatbot.css">
<link rel="stylesheet" href="/assets/css/pop.css">
<script src="/assets/js/chatbot.js" defer></script>

<?php if (!$isLoggedIn && $randomImg): ?>
<!-- POPUP DE CADASTRO/LOGIN -->
<div id="popup-overlay">
 <div id="popup-box">
  <button class="fechar-x" onclick="fecharPopup()">×</button>
  <img src="<?= $randomImg ?>" alt="Imagem do popup" class="popup-img">
  <h2>Bem-vindo!</h2>
  <p>Cadastre-se ou entre na sua conta para aproveitar todos os recursos da plataforma!</p>
  <div class="popup-buttons">
    <a href="javascript:void(0);" onclick="openRegisterModal(); fecharPopup();" class="btn-cadastro">Criar conta</a>
    <a href="javascript:void(0);" onclick="openLoginModal(); fecharPopup();" class="btn-login">Entrar</a>
  </div>
</div>

</div>
<?php endif; ?>

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

<!-- Script para fechar popup -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("popup-overlay");
    const fecharX = document.querySelector(".fechar-x");

    // Exibir o X após 4 segundos
    setTimeout(() => {
      if (fecharX) {
        fecharX.style.display = "block";
      }
    }, 4000);

    // Função global para fechar popup (usada nos botões Entrar/Cadastrar e X)
    window.fecharPopup = function () {
      if (popup) popup.style.display = "none";
    };
  });
</script>

</script>
