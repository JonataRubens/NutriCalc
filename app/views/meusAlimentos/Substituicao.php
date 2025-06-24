<?php session_start();?>
<?php include('../public/includes/NavBar.php');?>
<link rel="stylesheet" href="/assets/css/Substituicao.css">  


<title>Lista de Substituição</title>
<main id="substituicao-wrapper">
      <div class="container">
        <header class="header" id="headerSubstituicao">
  <h1 class="title" id="tituloSubstituicao">Lista de Substituição de Alimentos</h1>
  <p class="subtitle" id="subtituloSubstituicao">Encontre alternativas mais próximas para seus alimentos.</p>
</header>

<section class="search-section" id="searchSection">
  <div class="input-wrapper" id="inputWrapper">
    <input type="text" id="searchInput" placeholder="Pesquisar alimento..." class="search-input">
    <button id="clearBtn" aria-label="Limpar campo de pesquisa">&times;</button>
  </div>
  <div id="searchResultsDropdown" class="dropdown-content"></div>
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

    <script src="/assets/js/Substituicao.js"></script>
</main>
<script>

    document.addEventListener('DOMContentLoaded', function () {
  const clearBtn = document.getElementById('clearBtn');
  const searchInput = document.getElementById('searchInput');

  // Ocultar botão inicialmente
  clearBtn.style.display = 'none';

  // Mostrar o botão apenas se houver texto
  searchInput.addEventListener('input', function () {
    clearBtn.style.display = this.value.length > 0 ? 'inline-block' : 'none';
  });

  // Ação do botão para limpar
  clearBtn.addEventListener('click', function () {
    searchInput.value = '';
    clearBtn.style.display = 'none';
    searchInput.focus();
  });
});

</script>
<?php include('../public/includes/Footer.html'); ?>
