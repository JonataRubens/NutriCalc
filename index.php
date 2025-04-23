<!DOCTYPE html>
<?php
require_once 'includes/db_connection.php';
?>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabela Nutricional - NutriCalc</title>
  <link rel="stylesheet" href="assets/css/Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="container">
      <nav>
        <ul>
          <li><a href="index.php">Página inicial</a></li>
          <li><a href="pages/Calculadoras.php">Ferramentas Nutricionais</a></li>
          <li><a href="pages/Blog.php">Blog</a></li>
        </ul>
        <div class="nav-right">
          <a href="pages/Login.php" class="btn-entrar">Entrar</a>
          <a href="pages/Register.php" class="btn-criar">Criar Conta</a>
        </div>
      </nav>
    </div>
  </header>

  <!-- Conteúdo principal -->
  <main class="container">
    <section class="hero">
      <h1>Tabela Nutricional</h1>
      <p>Plataforma nutricional completa, fornecendo informações detalhadas sobre alimentos e ferramentas de apoio para uso pessoal.</p>

      <input type="text" placeholder="🔍 Pesquisar alimento..." class="search-input">

      <div class="filtros">
        <label><input type="radio" name="filtro" checked> Todas as tabelas</label>
      </div>
    </section>

    <!-- Grupos alimentares -->
    <section class="grupos">
      <h3>Grupos alimentares</h3>
      <div class="grid-grupos">
        <button>Bebidas</button>
        <button>Carnes </button>
        <button>Cereais </button>
        <button>Frutas </button>
      </div>
    </section>

    <!-- Calculadoras -->

    <section class="conheca">
      <h3>Conheça nossas Ferramentas Nutricionais</h3>
      <div class="cards-simples">
        <a href="#" class="card" >Calculadora de Calorias</a>
        <a href="#" class="card" >Calculadora de IMC e Peso Ideal</a>
        <a href="pages/Ferramentas/QTDAagua.php" class="card card-agua">Quantidade de Água Ideal</a>
        <a href="pages/Ferramentas/CalcCalorias.php" class="card card-agua">Calculadora de Gasto Calorico</a>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <h4>NutriCalc</h4>
          <p>Plataforma de apoio nutricional completa para usuários comuns.</p>
        </div>
        <div class="footer-col">
          <h4>Links rápidos</h4>
          <ul>
            <li><a href="index.php">Página inicial</a></li>
            <li><a href="pages/Calculadoras.php">Ferramentas Nutricionais</a></li>
            <li><a href="pages/Blog.php">Blog</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Contato</h4>
          <p>Email: nutricalc</p>
          <p>Suporte: snutricalc</p>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 NutriCalc. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>


</body>
</html>
