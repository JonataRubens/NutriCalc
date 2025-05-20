<?php include __DIR__ . '/../partials/navbar.php'; ?>
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
            <a href="/Ferramentas/PagCalcCalorias" class="card">Calculadora de Calorias</a>
            <a href="/Ferramentas/Imc" class="card">Calculadora de IMC e Peso Ideal</a>
            <a href="/Ferramentas/QTDAagua" class="card card-agua">Quantidade de Água Ideal</a>
        </div>
    </section>
</main>
<script src="/assets/js/BuscarAlimento.js"></script>
<?php include __DIR__ . '/../partials/footer.php'; ?>
