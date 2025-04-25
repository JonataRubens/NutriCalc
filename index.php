<?php include('includes/NavBar.php'); ?>
<link rel="stylesheet" href="assets/css/Style.css">
<link rel="stylesheet" href="assets/css/BarraDePesquisa.css">
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
      </div>
    </section>

  </main>

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
 <?php include('includes/Footer.html'); ?>