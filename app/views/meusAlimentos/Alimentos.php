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
<title>Lista de Alimentos</title>

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

  document.querySelector('form[action="/Urls.php?page=alimentospdf"]').addEventListener('submit', function(e) {
  const inputHidden = this.querySelector('input[name="lista_alimentos"]');
  inputHidden.value = JSON.stringify(selectedAlimentos);
});
</script>
<?php include('../public/includes/Footer.html'); ?>