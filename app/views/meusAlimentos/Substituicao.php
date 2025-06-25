<?php
session_start();
include('../public/includes/NavBar.php');
include __DIR__ . '/../../../public/includes/db_connection.php';
?>
<link rel="stylesheet" href="/assets/css/Style.css"> <link rel="stylesheet" href="/assets/css/BarraDePesquisa.css"> <link rel="stylesheet" href="/assets/css/Substituicao.css"> <title>Lista de Substituição</title>

</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="title">Lista de Substituição de Alimentos</h1>
            <p class="subtitle">Encontre alternativas mais próximas para seus alimentos.</p>
        </header>

        <section class="search-section">
            <div class="input-wrapper">
                <input type="text" id="searchInput" placeholder="Pesquisar alimento..." class="search-input">
                <button id="clearBtn" aria-label="Limpar campo de pesquisa">&times;</button>
            </div>
            <div id="searchResultsDropdown" class="dropdown-content">
            </div>
        </section>

        <section id="resultsSection" class="results-section" style="display: none;">
            <div class="alimento-selecionado">
                <h3>Alimento Selecionado:</h3>
                <p><strong>Descrição:</strong> <span id="selectedFoodDescription"></span></p>
                <p><strong>Energia:</strong> <span id="selectedFoodEnergy"></span> kcal</p>
            </div>

            <div class="similar-foods-display">
                <h3>Sugestões de Substituição:</h3>
                <div id="similarFoodsTableContainer">
                    </div>
            </div>
        </section>
    </div>

    <script src="/assets/js/Substituicao.js"></script> <?php include('../public/includes/Footer.html'); ?>
</body>
</html>