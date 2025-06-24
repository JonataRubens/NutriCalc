<?php

session_start();

// Bloqueia o acesso se não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /');
    exit();
}
include('../public/includes/NavBar.php');
include __DIR__ . '/../../../public/includes/db_connection.php';
?>
<link rel="stylesheet" href="/assets/css/MeusAlimentos.css">
<link rel="stylesheet" href="/assets/css/Modal.css"> <title>Lista de Alimentos</title>

</head>
 <div id="alimentosPage">
  <main class="container1">
    <h1>Meus Alimentos</h1>


  <div class="search-bar-wrapper">
  <div class="input-wrapper">
    <input type="text" id="searchInput" placeholder="🔍 Pesquisar alimento..." class="search-input" />
    <button id="clearBtn" aria-label="Limpar campo de pesquisa">&times;</button>
  </div>

  <form method="post" action="/Urls.php?page=alimentospdf" target="_blank" id="formRelatorio">
  <input type="hidden" name="lista_alimentos" id="inputListaAlimentos">
  <button type="submit" class="btn-pdf">
    Gerar Relatório
  </button>
</form>
</div>
    
    <div id="searchResults" class="search-results">
      </div>

    <h2>Minha Lista</h2>
    <div id="selectedList" class="selected-list">
      </div>
  </main>

  <div id="substituteModal" class="modal">
    <div class="modal-content">
      <span class="close-button" id="closeSubstituteModal">&times;</span>
      <h2>Substituir Alimento</h2>
      <p>Alimento mais proximos</p>
      <div id="similarFoodsList" class="similar-foods-list">
              <button id="cancelSubstituteBtn" class="btn-cancel">Cancelar</button>
        </div>

    </div>
  </div>

 </div>
<script src="/assets/js/Alimentos.js"></script>
<?php include('../public/includes/Footer.html'); ?>