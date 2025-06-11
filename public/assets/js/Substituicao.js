document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const clearBtn = document.getElementById('clearBtn');
    const searchResultsDropdown = document.getElementById('searchResultsDropdown');
    const resultsSection = document.getElementById('resultsSection');
    const selectedFoodDescription = document.getElementById('selectedFoodDescription');
    const selectedFoodEnergy = document.getElementById('selectedFoodEnergy');
    const similarFoodsTableContainer = document.getElementById('similarFoodsTableContainer');

    let debounceTimer;
    let selectedIndex = -1; // Para navegação com teclado no dropdown
    let currentSearchItems = []; // Itens atualmente no dropdown de busca

    // Função para buscar alimentos no backend para o dropdown
    function searchFoodsForDropdown(term) {
        if (term.length < 2) { // Começa a buscar a partir de 2 caracteres
            hideDropdown();
            return;
        }

        fetch(`api/Alimentos.php?termo=${encodeURIComponent(term)}`)
            .then(response => response.json())
            .then(data => {
                currentSearchItems = data;
                displayDropdownResults(data);
            })
            .catch(error => {
                console.error('Erro na busca de alimentos:', error);
                searchResultsDropdown.innerHTML = '<p>Erro ao buscar alimentos.</p>';
                showDropdown();
            });
    }

    // Exibe os resultados da busca no dropdown
    function displayDropdownResults(alimentos) {
        searchResultsDropdown.innerHTML = ''; // Limpa resultados anteriores
        if (alimentos.length === 0) {
            searchResultsDropdown.innerHTML = '<p>Nenhum alimento encontrado.</p>';
            showDropdown();
            return;
        }

        alimentos.forEach((alimento, index) => {
            const div = document.createElement('div');
            div.classList.add('dropdown-item');
            div.textContent = `${alimento.descricao} (${alimento.categoria})`;
            div.dataset.id = alimento.id;
            div.dataset.energia = alimento.energia;
            div.dataset.descricao = alimento.descricao;
            div.dataset.categoria = alimento.categoria;
            div.dataset.proteina = alimento.proteina;
            div.dataset.lipideos = alimento.lipideos;
            div.dataset.carboidratos = alimento.carboidratos;
            div.addEventListener('click', () => selectFoodFromDropdown(alimento));
            searchResultsDropdown.appendChild(div);
        });
        showDropdown();
    }

    // Seleciona um alimento do dropdown e exibe os similares
    function selectFoodFromDropdown(alimento) {
        searchInput.value = alimento.descricao; // Preenche o input com o selecionado
        hideDropdown();
        clearBtn.style.display = 'block';

        selectedFoodDescription.textContent = alimento.descricao;
        selectedFoodEnergy.textContent = alimento.energia;
        resultsSection.style.display = 'block'; // Mostra a seção de resultados

        // Agora, busca os alimentos similares
        buscarAlimentosSimilares(alimento.energia);
    }

    // Função para buscar alimentos similares (já existente na API)
    function buscarAlimentosSimilares(energia) {
        similarFoodsTableContainer.innerHTML = '<p>Buscando sugestões...</p>';
        fetch(`api/Alimentos.php?acao=get_similar_by_calories&energia=${energia}`)
            .then(res => res.json())
            .then(data => mostrarAlimentosSimilares(data))
            .catch(err => {
                console.error('Erro ao buscar alimentos similares:', err);
                similarFoodsTableContainer.innerHTML = '<p>Erro ao carregar sugestões.</p>';
            });
    }

    // Exibe os alimentos similares na tabela
    function mostrarAlimentosSimilares(alimentos) {
        const container = similarFoodsTableContainer;
        if (alimentos.length === 0) {
            container.innerHTML = '<p>Nenhuma sugestão encontrada.</p>';
            return;
        }
        
        let html = '<table><thead><tr><th>Descrição</th><th>Categoria</th><th>Energia (kcal)</th><th>Proteína (g)</th><th>Lipídios (g)</th><th>Carboidratos (g)</th></tr></thead><tbody>';
        
        alimentos.forEach(alimento => {
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

    // Lógica para mostrar/esconder dropdown
    function showDropdown() {
        searchResultsDropdown.style.display = 'block';
    }

    function hideDropdown() {
        searchResultsDropdown.style.display = 'none';
        selectedIndex = -1; // Reseta o índice de seleção
    }

    // Event listener para input com debounce
    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            searchFoodsForDropdown(this.value.trim());
        }, 300);
        clearBtn.style.display = this.value.trim().length > 0 ? 'block' : 'none';
        resultsSection.style.display = 'none'; // Esconde resultados anteriores ao digitar
    });

    // Limpar campo de busca
    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        hideDropdown();
        clearBtn.style.display = 'none';
        resultsSection.style.display = 'none';
        searchInput.focus();
    });

    // Navegação com teclado no dropdown
    searchInput.addEventListener('keydown', function(e) {
        const items = Array.from(searchResultsDropdown.children);
        if (items.length === 0) return;

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            selectedIndex = (selectedIndex + 1) % items.length;
            updateSelection(items);
            items[selectedIndex].scrollIntoView({ block: 'nearest' });
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            selectedIndex = (selectedIndex - 1 + items.length) % items.length;
            updateSelection(items);
            items[selectedIndex].scrollIntoView({ block: 'nearest' });
        } else if (e.key === 'Enter') {
            e.preventDefault();
            if (selectedIndex > -1 && currentSearchItems[selectedIndex]) {
                selectFoodFromDropdown(currentSearchItems[selectedIndex]);
            }
        } else if (e.key === 'Escape') {
            hideDropdown();
        }
    });

    function updateSelection(items) {
        items.forEach((item, index) => {
            item.classList.toggle('highlighted', index === selectedIndex);
        });
    }

    // Fechar dropdown ao clicar fora
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResultsDropdown.contains(e.target)) {
            hideDropdown();
        }
    });
});