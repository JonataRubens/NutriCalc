<!DOCTYPE html>
<?php include('includes/NavBar.php'); ?>
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

      </div>
    </section>
</main>
<?php include('includes/Footer.html'); ?>