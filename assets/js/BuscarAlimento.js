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
