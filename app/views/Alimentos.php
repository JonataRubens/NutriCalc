<?php

session_start();

// Bloqueia o acesso se não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /');
    exit();
}
include('../public/includes/NavBar.php');
include __DIR__ . '/../../public/includes/db_connection.php';
?>
<title>Lista de Alimentos</title>

<style>

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f7f9fc;
}

.container1 {
  background: #fff;
  padding: 25px 30px 50px 30px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  width: 100%;
  max-width: 1000px;
  max-height: 1500px;
  box-sizing: border-box;
  overflow: hidden; /* Impede que o conteúdo saia do container */
}

h1 {
  margin-bottom: 20px;
  color: #222;
  font-weight: 700;
}

h2 {
  margin-top: 35px;
  margin-bottom: 15px;
  color: #333;
  font-weight: 600;
}

input.search-input {
  width: 100%;
  padding: 12px 15px;
  font-size: 16px;
  border-radius: 8px;
  border: 1.8px solid #ccc;
  outline-offset: 2px;
  transition: border-color 0.3s ease;
  box-sizing: border-box;
}

input.search-input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 8px rgba(59, 130, 246, 0.4);
}

/* Containers das tabelas com controle de overflow */
.search-results, .selected-list {
  max-height: 300px;
  overflow-y: auto;
  overflow-x: auto; /* Scroll horizontal quando necessário */
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 0;
  background-color: white;
  width: 100%;
  box-sizing: border-box;
}

/* Tabelas com largura controlada */
.search-results table,
.selected-list table {
  width: 100%;
  min-width: 600px; /* Largura mínima para manter legibilidade */
  max-width: 100%; /* Não excede o container */
  border-collapse: collapse;
  font-size: 15px;
  table-layout: fixed; /* Força controle das larguras das colunas */
}

/* Colunas com larguras específicas e controle de texto */
.search-results th,
.selected-list th,
.search-results td,
.selected-list td {
  padding: 10px 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
  vertical-align: middle;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* Larguras específicas para cada coluna */
.search-results th:nth-child(1),
.selected-list th:nth-child(1),
.search-results td:nth-child(1),
.selected-list td:nth-child(1) {
  width: 30%; /* Descrição */
  white-space: normal; /* Permite quebra na descrição */
}

.search-results th:nth-child(2),
.selected-list th:nth-child(2),
.search-results td:nth-child(2),
.selected-list td:nth-child(2) {
  width: 20%; /* Categoria */
}

.search-results th:nth-child(3),
.selected-list th:nth-child(3),
.search-results td:nth-child(3),
.selected-list td:nth-child(3),
.search-results th:nth-child(4),
.selected-list th:nth-child(4),
.search-results td:nth-child(4),
.selected-list td:nth-child(4),
.search-results th:nth-child(5),
.selected-list th:nth-child(5),
.search-results td:nth-child(5),
.selected-list td:nth-child(5),
.search-results th:nth-child(6),
.selected-list th:nth-child(6),
.search-results td:nth-child(6),
.selected-list td:nth-child(6) {
  width: 10%; /* Valores nutricionais */
  text-align: center;
}

.search-results th:nth-child(7),
.selected-list th:nth-child(7),
.search-results td:nth-child(7),
.selected-list td:nth-child(7) {
  width: 10%; /* Ação */
  text-align: center;
}

.search-results th,
.selected-list th {
  background-color: #f0f4f8;
  font-weight: 600;
  color: #444;
  position: sticky;
  top: 0;
  z-index: 10;
}

.search-results tr:hover,
.selected-list tr:hover {
  background-color: #f9fafb;
}

button {
  padding: 6px 12px;
  border: none;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-size: 12px;
  white-space: nowrap;
}

button:hover {
  opacity: 0.85;
}

button:focus {
  outline: 2px solid #3b82f6;
  outline-offset: 2px;
}

.search-results button {
  background-color: #10b981;
  color: #fff;
}

.selected-list button {
  background-color: #ef4444;
  color: #fff;
}

.search-results p,
.selected-list p {
  color: #666;
  font-style: italic;
  padding: 20px;
  text-align: center;
}

#alimentosPage {
  background: #f7f9fc;
  padding: 40px 20px;
  display: flex;
  justify-content: center;
  min-height: 100vh;
  box-sizing: border-box;
}

.input-wrapper {
  position: relative;
  max-width: 400px;
  margin-bottom: 20px;
}

.input-wrapper input {
  width: 100%;
  padding-right: 30px;
  box-sizing: border-box;
}

.input-wrapper button#clearBtn {
  position: absolute;
  top: 50%;
  right: 8px;
  transform: translateY(-50%) 10px;
  width: 20px;
  height: 20px;
  background: #ccc;
  border: none;
  border-radius: 50%;
  font-weight: bold;
  color: #333;
  cursor: pointer;
  padding: 0;
  line-height: 20px;
  text-align: center;
  display: none;
  user-select: none;
  transition: background-color 0.3s ease;
}

.input-wrapper button#clearBtn:hover {
  background: #999;
  color: white;
}

/* Responsividade */
@media (max-width: 768px) {
  #alimentosPage {
    padding: 20px 10px;
  }
  
  .container1 {
    padding: 20px 15px;
    margin: 0 10px;
  }
  
  .search-results table,
  .selected-list table {
    min-width: 500px;
    font-size: 14px;
  }
  
  .search-results th,
  .selected-list th,
  .search-results td,
  .selected-list td {
    padding: 8px 6px;
  }
}

@media (max-width: 600px) {
  .container1 {
    padding: 20px 15px;
  }
  
  .search-results th,
  .selected-list th,
  .search-results td,
  .selected-list td {
    padding: 8px 6px;
    font-size: 14px;
  }
  
  input.search-input {
    font-size: 14px;
    padding: 10px 12px;
  }
  
  .search-results table,
  .selected-list table {
    min-width: 450px;
  }
}
/* Esconde os resultados da busca inicialmente */
.search-results {
  display: none; /* Inicialmente escondido */
  max-height: 300px;
  overflow-y: auto;
  overflow-x: auto;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 0;
  background-color: white;
  width: 100%;
  box-sizing: border-box;
}


</style>


</head>
 <div id="alimentosPage">
  <main class="container1">
    <h1>Meus Alimentos</h1>

    <div class="input-wrapper">
      <input type="text" id="searchInput" placeholder="🔍 Pesquisar alimento..." class="search-input" />
      <button id="clearBtn" aria-label="Limpar campo de pesquisa">&times;</button>
    </div>

    <div id="searchResults" class="search-results">
      <!-- Resultados da pesquisa com botão Adicionar -->
    </div>

    <h2>Minha Lista</h2>
    <div id="selectedList" class="selected-list">
      <!-- Alimentos adicionados com botão Remover -->
    </div>
  </main>
  </div>

<script>
  const clearBtn = document.getElementById('clearBtn');
  const searchInput = document.getElementById('searchInput');
  const searchResults = document.getElementById('searchResults');

  // Event listeners para o campo de busca e botão limpar
  searchInput.addEventListener('input', () => {
    if (searchInput.value.trim().length > 0) {
      clearBtn.style.display = 'block';
    } else {
      clearBtn.style.display = 'none';
      searchResults.style.display = 'none';
    }
  });

  clearBtn.addEventListener('click', () => {
    searchInput.value = '';
    clearBtn.style.display = 'none';
    searchResults.style.display = 'none';
    searchInput.focus();
  });

  let selectedAlimentos = [];

  // Carrega a lista salva do usuário
  function carregarListaSalva() {
    fetch('includes/gerenciar_lista.php?acao=carregar')
      .then(res => res.json())
      .then(data => {
        selectedAlimentos = data;
        mostrarListaSelecionada();
      })
      .catch(err => {
        console.error('Erro ao carregar lista:', err);
      });
  }

  // Função para buscar alimentos do backend
  function buscarAlimentos(term = '') {
    if (!term || term.trim() === '') {
      document.getElementById('searchResults').style.display = 'none';
      return;
    }
    
    document.getElementById('searchResults').style.display = 'block';
    
    fetch(`includes/search_alimentos.php?term=${encodeURIComponent(term)}`)
      .then(res => res.json())
      .then(data => mostrarResultadosBusca(data))
      .catch(err => {
        console.error('Erro ao buscar alimentos:', err);
        document.getElementById('searchResults').innerHTML = '<p>Erro ao carregar alimentos.</p>';
      });
  }

  // Mostrar resultados da busca com botão "Adicionar"
  function mostrarResultadosBusca(alimentos) {
    const container = document.getElementById('searchResults');
    if (alimentos.length === 0) {
      container.innerHTML = '<p>Alimento não encontrado.</p>';
      return;
    }
    
    let html = '<table><thead><tr><th>Descrição</th><th>Categoria</th><th>Energia</th><th>Proteína</th><th>Lipídios</th><th>Carboidratos</th><th>Ação</th></tr></thead><tbody>';
    
    alimentos.forEach(alimento => {
      const jaSelecionado = selectedAlimentos.some(sel => sel.id === alimento.id);
      
      html += `<tr data-id="${alimento.id}">
        <td>${alimento.descricao}</td>
        <td>${alimento.categoria}</td>
        <td>${alimento.energia}</td>
        <td>${alimento.proteina}</td>
        <td>${alimento.lipideos}</td>
        <td>${alimento.carboidratos}</td>
        <td>${jaSelecionado ? '' : `<button onclick="adicionarAlimento(${alimento.id})">Adicionar</button>`}</td>
      </tr>`;
    });
    
    html += '</tbody></table>';
    container.innerHTML = html;
  }

  // Mostrar lista selecionada com botão "Remover"
  function mostrarListaSelecionada() {
    const container = document.getElementById('selectedList');
    if (selectedAlimentos.length === 0) {
      container.innerHTML = '<p>Lista vazia.</p>';
      return;
    }
    
    let html = '<table><thead><tr><th>Descrição</th><th>Categoria</th><th>Energia</th><th>Proteína</th><th>Lipídios</th><th>Carboidratos</th><th>Ação</th></tr></thead><tbody>';
    
    selectedAlimentos.forEach(alimento => {
      html += `<tr data-id="${alimento.id}">
        <td>${alimento.descricao}</td>
        <td>${alimento.categoria}</td>
        <td>${alimento.energia}</td>
        <td>${alimento.proteina}</td>
        <td>${alimento.lipideos}</td>
        <td>${alimento.carboidratos}</td>
        <td><button onclick="removerAlimento(${alimento.id})">Remover</button></td>
      </tr>`;
    });
    
    html += '</tbody></table>';
    container.innerHTML = html;
  }

  // Adiciona alimento na lista selecionada e salva no banco
  function adicionarAlimento(id) {
    const row = document.querySelector(`#searchResults tr[data-id="${id}"]`);
    if (!row) return;
    
    const alimento = {
      id: id,
      descricao: row.cells[0].textContent,
      categoria: row.cells[1].textContent,
      energia: row.cells[2].textContent,
      proteina: row.cells[3].textContent,
      lipideos: row.cells[4].textContent,
      carboidratos: row.cells[5].textContent
    };
    
    // Salva no banco de dados
    const formData = new FormData();
    formData.append('acao', 'adicionar');
    formData.append('id_alimento', alimento.id);
    formData.append('descricao', alimento.descricao);
    formData.append('categoria', alimento.categoria);
    formData.append('energia', alimento.energia);
    formData.append('proteina', alimento.proteina);
    formData.append('lipideos', alimento.lipideos);
    formData.append('carboidratos', alimento.carboidratos);
    
    fetch('includes/gerenciar_lista.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        selectedAlimentos.push(alimento);
        mostrarListaSelecionada();
        buscarAlimentos(document.getElementById('searchInput').value.trim());
      } else {
        alert(data.error || 'Erro ao adicionar alimento');
      }
    })
    .catch(err => {
      console.error('Erro ao adicionar alimento:', err);
    });
  }

  // Remove alimento da lista selecionada e do banco
  function removerAlimento(id) {
    const formData = new FormData();
    formData.append('acao', 'remover');
    formData.append('id_alimento', id);
    
    fetch('includes/gerenciar_lista.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        selectedAlimentos = selectedAlimentos.filter(a => a.id !== id);
        mostrarListaSelecionada();
        buscarAlimentos(document.getElementById('searchInput').value.trim());
      } else {
        alert('Erro ao remover alimento');
      }
    })
    .catch(err => {
      console.error('Erro ao remover alimento:', err);
    });
  }

  // Pesquisa com debounce
  let debounceTimer;
  document.getElementById('searchInput').addEventListener('input', function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
      buscarAlimentos(this.value.trim());
    }, 300);
  });

  // Carrega a lista salva do usuário ao inicializar
  carregarListaSalva();


</script>


  
<?php include('../public/includes/Footer.html'); ?>