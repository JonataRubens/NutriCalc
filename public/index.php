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

    <!-- Ranking de alimentos -->
    <section class="ranking">
        <h3>Ranking de Alimentos</h3>
        <form id="ranking-form">
            <label for="filtro">Filtrar por:</label>
            <select name="filtro" id="filtro">
                <option value="energia">Calorias</option>
                <option value="carboidratos">Carboidratos</option>
                <option value="lipideos">Lipídios</option>
                <option value="proteina">Proteína</option>
            </select>
            <label for="ordem">Ordem:</label>
            <select name="ordem" id="ordem">
                <option value="desc">Maior primeiro</option>
                <option value="asc">Menor primeiro</option>
            </select>
            <label for="limite">Quantidade:</label>
            <input type="number" name="limite" id="limite" value="10" min="1" max="100">
            <button type="submit">Ver Ranking</button>
        </form>
        <table border="1" id="ranking-table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Calorias</th>
                    <th>Carboidratos</th>
                    <th>Lipídios</th>
                    <th>Proteína</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </section>

    <!-- Calculadoras -->
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

<script>
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.trim();
    const resultsContainer = document.getElementById('searchResults');

    if (searchTerm.length < 3) {
        resultsContainer.innerHTML = '';
        return;
    }

    fetch(`/api/Alimentos.php?termo=${encodeURIComponent(searchTerm)}`)
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
    resultsContainer.innerHTML = '<p>Carregando...</p>';

    fetch(`/api/Alimentos.php?categoria=${encodeURIComponent(category)}`)
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
    if (!data || data.length === 0) {
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

// Correção do ranking para evitar conflitos
document.getElementById('ranking-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let filtro = document.getElementById('filtro').value;
    let ordem = document.getElementById('ordem').value;
    let limite = parseInt(document.getElementById('limite').value);

    const tbody = document.querySelector('#ranking-table tbody');
    tbody.innerHTML = '<tr><td colspan="6">Carregando...</td></tr>';

    fetch('/api/Alimentos.php')
        .then(response => response.json())
        .then(data => {
            if (!data || data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6">Nenhum alimento encontrado.</td></tr>';
                return;
            }

            data.sort((a, b) => {
                let numA = parseFloat(a[filtro]) || 0;
                let numB = parseFloat(b[filtro]) || 0;
                return ordem === 'asc' ? numA - numB : numB - numA;
            });

            data = data.slice(0, limite);

            tbody.innerHTML = '';
            data.forEach(alimento => {
                tbody.innerHTML += `
                    <tr>
                        <td>${alimento.descricao}</td>
                        <td>${alimento.categoria}</td>
                        <td>${alimento.energia}</td>
                        <td>${alimento.carboidratos}</td>
                        <td>${alimento.lipideos}</td>
                        <td>${alimento.proteina}</td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            console.error('Erro ao carregar ranking:', error);
            tbody.innerHTML = '<tr><td colspan="6">Erro ao carregar os dados.</td></tr>';
        });
});

// Garante que ambos os scripts funcionem corretamente ao carregar a página
window.onload = () => {
    document.getElementById('ranking-form').dispatchEvent(new Event('submit'));
};
</script>



<?php include('includes/Footer.html'); ?>
