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

      <input type="text" id="searchInput" placeholder="🔍 Pesquisar alimento..." class="search-input">

      <div class="filtros">
        <label><input type="radio" name="filtro" checked> Todas as tabelas</label>
      </div>
      
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

  <script>
    document.getElementById('searchInput').addEventListener('input', function(e) {
      const searchTerm = e.target.value.trim();
      const resultsContainer = document.getElementById('searchResults');
      
      if (searchTerm.length < 3) {
        resultsContainer.innerHTML = '';
        return;
      }
      
      fetch(`includes/search_alimentos.php?term=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(data => {
          displayResults(data, resultsContainer);
        })
        .catch(error => {
          console.error('Erro ao buscar alimentos:', error);
          resultsContainer.innerHTML = '<p>Erro ao realizar a pesquisa.</p>';
        });
    });

    function searchByCategory(category) {
      const resultsContainer = document.getElementById('searchResults');
      fetch(`includes/search_alimentos.php?term=${encodeURIComponent(category)}`)
        .then(response => response.json())
        .then(data => {
          displayResults(data, resultsContainer);
        })
        .catch(error => {
          console.error('Erro ao buscar alimentos por categoria:', error);
          resultsContainer.innerHTML = '<p>Erro ao realizar a pesquisa por categoria.</p>';
        });
    }

    function displayResults(data, container) {
      if (data.length === 0) {
        container.innerHTML = '<p>Nenhum alimento encontrado.</p>';
        return;
      }
      
      let html = '<h3>Resultados da Pesquisa</h3>';
      html += '<table class="results-table">';
      html += '<thead><tr><th>Descrição</th><th>Categoria</th><th>Energia (kcal)</th><th>Proteína (g)</th><th>Lipídios (g)</th><th>Carboidratos (g)</th></tr></thead>';
      html += '<tbody>';
      
      data.forEach(alimento => {
        html += `<tr>
          <td>${alimento.descricao}</td>
          <td>${alimento.categoria}</td>
          <td>${alimento.energia}</td>
          <td>${alimento.proteina}</td>
          <td>${alimento.lipideos}</td>
          <td>${alimento.carboidratos}</td>
        </tr>`;
      });
      
      html += '</tbody></table>';
      container.innerHTML = html;
    }
  </script>
  
  <style>
    .search-results {
      margin-top: 20px;
      max-height: 400px;
      overflow-y: auto;
    }
    .results-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    .results-table th, .results-table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    .results-table th {
      background-color: #f2f2f2;
    }
    .results-table tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .results-table tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</body>
</html>
