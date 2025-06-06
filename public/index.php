<?php require_once __DIR__ . '/../router.php'; ?>
<?php include __DIR__ . '/../app/views/chatbot.php'; ?>
<link rel="stylesheet" href="/assets/css/chatbot.css">
<script src="/assets/js/chatbot.js" defer></script>

<?php include('includes/NavBar.php'); ?>

  
<!-- Conteúdo principal -->
  <main class="container">
    <section class="hero">
      <h1>Tabela Nutricional</h1>
      <p>Plataforma nutricional completa, fornecendo informações detalhadas sobre alimentos e ferramentas de apoio para uso pessoal.</p>

      <input type="text" id="searchInput" placeholder="🔍 Pesquisar alimento..." class="search-input">
      
      <div id="searchResults" class="search-results">
        <!-- Resultados da pesquisa serão exibidos aqui -->
      </div>
    </section>

    <!-- Grupos alimentares -->
    <section class="grupos">
      <h3>Grupos alimentares</h3>
      <div class="grid-grupos">
        <button onclick="searchByCategory('Bebidas')">Bebidas</button>
        <button onclick="searchByCategory('Carnes')">Carnes</button>
        <button onclick="searchByCategory('Cereais')">Cereais</button>
        <button onclick="searchByCategory('Frutas')">Frutas</button>
      </div>
    </section>

    <!-- Calculadoras -->
    <hr class="linha-divisoria">
    <section class="conheca">
      <h3>Nossas Principais Ferramentas Nutricionais</h3>
      <div class="cards-simples">
        <a href="/Urls.php?page=cal-gasto" class="card" >Calculadora de Calorias</a>
        <a href="/Urls.php?page=imc" class="card" >Calculadora de IMC e Peso Ideal</a>
        <a href="/Urls.php?page=agua" class="card card-agua">Quantidade de Água Ideal</a>
      </div>
    </section>

  </main>

<script src="/assets/js/Index.js"></script>

<?php include __DIR__ . '/../app/views/chatbot.php'; ?>
 <?php include('includes/Footer.html'); ?>