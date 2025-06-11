const clearBtn = document.getElementById('clearBtn');
  const searchInput = document.getElementById('searchInput');
  const searchResults = document.getElementById('searchResults');
  const substituteModal = document.getElementById('substituteModal'); // Get the modal
  const closeSubstituteModalBtn = document.getElementById('closeSubstituteModal'); // Get the close button
  const cancelSubstituteBtn = document.getElementById('cancelSubstituteBtn'); // Get the cancel button
  const similarFoodsList = document.getElementById('similarFoodsList'); // Get the div for similar foods

  let selectedAlimentos = [];
  let currentFoodToSubstitute = null; // To store the food being substituted

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

  // Open the substitute modal
  function openSubstituteModal() {
    substituteModal.style.display = 'block';
  }

  // Close the substitute modal
  function closeSubstituteModal() {
    substituteModal.style.display = 'none';
    similarFoodsList.innerHTML = ''; // Clear previous results
    currentFoodToSubstitute = null; // Clear the stored food
  }

  // Event listeners for modal close buttons
  closeSubstituteModalBtn.addEventListener('click', closeSubstituteModal);
  cancelSubstituteBtn.addEventListener('click', closeSubstituteModal);

  // Close modal when clicking outside of it
  window.addEventListener('click', (event) => {
    if (event.target === substituteModal) {
      closeSubstituteModal();
    }
  });

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

  // Mostrar lista selecionada com botão "Remover" e "Substituir"
  function mostrarListaSelecionada() {
    const container = document.getElementById('selectedList');
    if (selectedAlimentos.length === 0) {
      container.innerHTML = '<p>Lista vazia.</p>';
      return;
    }
    
    let html = '<table><thead><tr><th>Descrição</th><th>Categoria</th><th>Energia</th><th>Proteína</th><th>Lipídios</th><th>Carboidratos</th><th colspan="2">Ação</th></tr></thead><tbody>';
    
    selectedAlimentos.forEach(alimento => {
      html += `<tr data-id="${alimento.id}" data-energia="${alimento.energia}">
        <td>${alimento.descricao}</td>
        <td>${alimento.categoria}</td>
        <td>${alimento.energia}</td>
        <td>${alimento.proteina}</td>
        <td>${alimento.lipideos}</td>
        <td>${alimento.carboidratos}</td>
        <td><button onclick="removerAlimento(${alimento.id})">Remover</button></td>
        <td><button onclick="prepararSubstituicao(${alimento.id}, ${alimento.energia})">Substituir</button></td>
      </tr>`;
    });
    
    html += '</tbody></table>';
    container.innerHTML = html;
  }

  // Prepara a substituição, abre o modal e busca alimentos similares
  function prepararSubstituicao(id, energia) {
    currentFoodToSubstitute = { id: id, energia: energia };
    openSubstituteModal();
    buscarAlimentosSimilares(energia);
  }

  // Função para buscar alimentos similares (no backend)
  function buscarAlimentosSimilares(energia) {
    similarFoodsList.innerHTML = '<p>Buscando alimentos similares...</p>';
    fetch(`api/Alimentos.php?acao=get_similar_by_calories&energia=${energia}`)
      .then(res => res.json())
      .then(data => mostrarAlimentosSimilares(data))
      .catch(err => {
        console.error('Erro ao buscar alimentos similares:', err);
        similarFoodsList.innerHTML = '<p>Erro ao carregar alimentos similares.</p>';
      });
  }

  // Mostra os alimentos similares no modal
  function mostrarAlimentosSimilares(alimentos) {
    const container = similarFoodsList;
    if (alimentos.length === 0) {
      container.innerHTML = '<p>Nenhum alimento similar encontrado.</p>';
      return;
    }
    
    let html = '<table><thead><tr><th>Descrição</th><th>Categoria</th><th>Energia</th><th>Ação</th></tr></thead><tbody>';
    
    alimentos.forEach(alimento => {
      html += `<tr data-id="${alimento.id}" data-energia="${alimento.energia}">
        <td>${alimento.descricao}</td>
        <td>${alimento.categoria}</td>
        <td>${alimento.energia}</td>
        <td><button onclick="confirmarSubstituicao(${alimento.id}, '${alimento.descricao}', '${alimento.categoria}', ${alimento.energia}, ${alimento.proteina}, ${alimento.lipideos}, ${alimento.carboidratos})">Selecionar</button></td>
      </tr>`;
    });
    
    html += '</tbody></table>';
    container.innerHTML = html;
  }

  // Confirma a substituição de um alimento
  function confirmarSubstituicao(novoId, novaDescricao, novaCategoria, novaEnergia, novaProteina, novoLipideos, novoCarboidratos) {
    if (!currentFoodToSubstitute) {
      alert('Erro: Alimento original não identificado para substituição.');
      return;
    }

    const originalId = currentFoodToSubstitute.id;

    const formData = new FormData();
    formData.append('acao', 'substituir');
    formData.append('original_id', originalId);
    formData.append('novo_id', novoId);
    formData.append('nova_descricao', novaDescricao);
    formData.append('nova_categoria', novaCategoria);
    formData.append('nova_energia', novaEnergia);
    formData.append('nova_proteina', novaProteina);
    formData.append('novo_lipideos', novoLipideos);
    formData.append('novo_carboidratos', novoCarboidratos);

    fetch('includes/gerenciar_lista.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        closeSubstituteModal();
        carregarListaSalva(); // Recarrega a lista para mostrar a alteração
        buscarAlimentos(document.getElementById('searchInput').value.trim()); // Atualiza resultados da busca também
      } else {
        alert(data.error || 'Erro ao substituir alimento.');
      }
    })
    .catch(err => {
      console.error('Erro na substituição:', err);
      alert('Erro de comunicação ao substituir alimento.');
    });
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