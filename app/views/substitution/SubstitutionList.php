<?php
// NutriCalc/app/views/substitution/SubstitutionList.php

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela Nutricional</title>
    <style>
        /* ... (Your CSS Styles) ... */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .title {
            font-size: 3rem;
            font-weight: 400;
            color: #2c3e50;
            margin-bottom: 20px;
            font-family: Georgia, serif;
        }

        .subtitle {
            font-size: 1.5rem;
            color: #5a6c7d;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .description {
            font-size: 1rem;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-section {
            max-width: 600px;
            margin: 0 auto 40px;
        }

        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            background-color: white;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #007bff;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.2rem;
        }

        .filters {
            text-align: center;
        }

        .filter-label {
            margin-right: 10px;
            color: #5a6c7d;
            font-weight: 500;
        }

        .filter-option {
            margin: 0 15px;
            color: #6c757d;
        }

        .filter-option input[type="radio"] {
            margin-right: 5px;
        }

        .results-section {
            display: none;
            margin-top: 40px;
        }

        .selected-food-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }

        .selected-food-title {
            font-size: 1.2rem;
            color: #2c3e50;
            font-weight: 600;
        }

        .share-btn {
            background: none;
            border: 1px solid #6c757d;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            color: #6c757d;
        }

        .food-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .food-name {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .food-group {
            color: #6c757d;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .nutrition-info {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .nutrition-item {
            display: flex;
            flex-direction: column;
        }

        .nutrition-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 2px;
        }

        .nutrition-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .energia {
            color: #007bff;
        }

        .base-calculation {
            text-align: right;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .base-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .suggestions-section {
            margin-top: 30px;
        }

        .suggestions-title {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .suggestions-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .portion-checkbox {
            margin-bottom: 20px;
        }

        .portion-checkbox input {
            margin-right: 8px;
        }

        .suggestions-table {
            width: 100%;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
        }

        .suggestions-table th {
            background-color: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 1px solid #e9ecef;
            font-size: 0.9rem;
        }

        .suggestions-table td {
            padding: 12px;
            border-bottom: 1px solid #f1f3f4;
            color: #2c3e50;
        }

        .suggestions-table tr:last-child td {
            border-bottom: none;
        }

        .suggestions-table tr:hover {
            background-color: #f8f9fa;
        }

        .energia-col {
            color: #007bff;
            font-weight: 600;
        }

        .more-suggestions {
            margin-top: 15px;
            color: #007bff;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .more-suggestions:hover {
            text-decoration: underline;
        }

        .nutrient-reference {
            margin-top: 20px;
            text-align: right;
        }

        .nutrient-reference select {
            padding: 5px 10px;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            background: white;
        }

        @media (max-width: 768px) {
            .title {
                font-size: 2rem;
            }

            .nutrition-info {
                gap: 15px;
            }

            .suggestions-table {
                font-size: 0.8rem;
            }

            .suggestions-table th,
            .suggestions-table td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Tabela Nutricional</h1>
            <h2 class="subtitle">Lista de substituições</h2>
            <p class="description">
                Consulte opções para substituição de um alimento com base em calorias, proteínas, carboidratos, entre outros.
            </p>
        </div>

        <div class="search-section">
            <div class="search-container">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" id="searchInput" placeholder="Pesquisar alimento...">
            </div>

            <div class="filters">
                <span class="filter-label">Filtrar por:</span>
                <label class="filter-option">
                    <input type="radio" name="filter" value="todas" checked> Todas as tabelas
                </label>
                <label class="filter-option">
                    <input type="radio" name="filter" value="taco"> TACO
                </label>
                <label class="filter-option">
                    <input type="radio" name="filter" value="ibge"> IBGE
                </label>
                <label class="filter-option">
                    <input type="radio" name="filter" value="meus"> Meus Alimentos
                </label>
            </div>
        </div>

        <div class="results-section" id="resultsSection">
            <div class="selected-food-header">
                <span class="selected-food-title">Alimento selecionado:</span>
                <button class="share-btn">📤</button>
            </div>

            <div class="food-card">
                <h3 class="food-name" id="foodName">Arroz carreteiro</h3>
                <p class="food-group">Grupo alimentar: Alimentos preparados</p>

                <div class="nutrition-info">
                    <div class="nutrition-item">
                        <span class="nutrition-label">Energia:</span>
                        <span class="nutrition-value energia" id="energia">154 kcal</span>
                    </div>
                    <div class="nutrition-item">
                        <span class="nutrition-label">Carboidratos:</span>
                        <span class="nutrition-value" id="carboidratos">11,60 g</span>
                    </div>
                    <div class="nutrition-item">
                        <span class="nutrition-label">Proteínas:</span>
                        <span class="nutrition-value" id="proteinas">10,80 g</span>
                    </div>
                    <div class="nutrition-item">
                        <span class="nutrition-label">Lipídeos:</span>
                        <span class="nutrition-value" id="lipideos">7,10 g</span>
                    </div>
                </div>

                <div class="base-calculation">
                    <span>Base do cálculo:</span>
                    <span class="base-value">100 gramas ✏️</span>
                </div>
            </div>

            <div class="suggestions-section">
                <h3 class="suggestions-title">Sugestões de substituição</h3>
                <p class="suggestions-subtitle">(com base no mesmo grupo alimentar)</p>

                <div class="portion-checkbox">
                    <label>
                        <input type="checkbox" id="maintainPortion"> Manter a mesma porção (100g)
                    </label>
                </div>

                <div class="nutrient-reference">
                    <label>Nutriente de referência:
                        <select id="nutrientReference">
                            <option value="energia">Energia</option>
                            <option value="carboidratos">Carboidratos</option>
                            <option value="proteinas">Proteínas</option>
                            <option value="lipideos">Lipídeos</option>
                        </select>
                    </label>
                </div>

                <table class="suggestions-table">
                    <thead>
                        <tr>
                            <th>Alimento</th>
                            <th>Quantidade</th>
                            <th>Energia</th>
                            <th>Carboidratos</th>
                            <th>Proteínas</th>
                            <th>Lipídeos</th>
                        </tr>
                    </thead>
                    <tbody id="suggestionsTableBody">
                        <tr>
                            <td>Salada, de legumes, cozida no vapor</td>
                            <td>440,00 g</td>
                            <td class="energia-col">154 kcal</td>
                            <td>31,24 g</td>
                            <td>8,80 g</td>
                            <td>1,32 g</td>
                        </tr>
                        <tr>
                            <td>Estrogonofe de carne</td>
                            <td>89 g</td>
                            <td class="energia-col">153,97 kcal</td>
                            <td>2,67 g</td>
                            <td>13,35 g</td>
                            <td>9,61 g</td>
                        </tr>
                        <tr>
                            <td>Quibebe</td>
                            <td>179 g</td>
                            <td class="energia-col">153,94 kcal</td>
                            <td>11,81 g</td>
                            <td>15,39 g</td>
                            <td>4,83 g</td>
                        </tr>
                    </tbody>
                </table>

                <div class="more-suggestions">
                    ⊖ Ver mais sugestões
                </div>
            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const resultsSection = document.getElementById('resultsSection');
        const foodName = document.getElementById('foodName');
        const energia = document.getElementById('energia');
        const carboidratos = document.getElementById('carboidratos');
        const proteinas = document.getElementById('proteinas');
        const lipideos = document.getElementById('lipideos');
        const suggestionsTableBody = document.getElementById('suggestionsTableBody');
        const foodGroup = document.getElementById('foodGroup');

        function searchFood() {
            const searchTerm = searchInput.value.toLowerCase().trim();

            if (searchTerm === '') {
                resultsSection.style.display = 'none';
                return;
            }

            //  Fetch substitutes from the server
            fetch(`Urls.php?page=get-substitutes&term=${encodeURIComponent(searchTerm)}`) // Changed URL
                .then(response => response.json())
                .then(data => {
                    console.log('aqui:',data)
                    if (data.food) {
                        displayFoodResults(data.food);
                    }
                    if (data.substitutes) {
                        displaySubstitutes(data.substitutes);
                    }
                    resultsSection.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching substitutes:', error);
                    resultsSection.style.display = 'none';
                    alert('Error fetching data. Please try again.');
                });
        }

        function displayFoodResults(food) {
            foodName.textContent = food.descricao;  // Assuming 'descricao' is the food name
            energia.textContent = `${food.energia} kcal`;
            carboidratos.textContent = `${food.carboidratos} g`;
            proteinas.textContent = `${food.proteina} g`;
            lipideos.textContent = `${food.lipideos} g`;
            foodGroup.textContent = `Grupo alimentar: ${food.categoria}`; // Assuming 'categoria' is the food group
        }

        function displaySubstitutes(substitutes) {
            suggestionsTableBody.innerHTML = '';
            substitutes.forEach(substitute => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${substitute.descricao}</td>
                    <td>${substitute.quantidade || '100 g'}</td>  
                    <td class="energia-col">${substitute.energia} kcal</td>
                    <td>${substitute.carboidratos} g</td>
                    <td>${substitute.proteina} g</td>
                    <td>${substitute.lipideos} g</td>
                `;
                suggestionsTableBody.appendChild(row);
            });
        }

        // Event listeners
        searchInput.addEventListener('input', searchFood);
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                searchFood();
            }
        });

        // Simula a funcionalidade de "Ver mais sugestões"
        document.querySelector('.more-suggestions').addEventListener('click', function () {
            if (this.textContent.includes('Ver mais')) {
                this.textContent = '⊕ Ver menos sugestões';
                // Aqui você adicionaria mais linhas à tabela
            } else {
                this.textContent = '⊖ Ver mais sugestões';
                // Aqui você removeria as linhas extras
            }
        });

        // Funcionalidade do checkbox "Manter a mesma porção"
        document.getElementById('maintainPortion').addEventListener('change', function () {
            // Aqui você implementaria a lógica para recalcular as quantidades
            console.log('Checkbox alterado:', this.checked);
        });

        // Funcionalidade do select "Nutriente de referência"
        document.getElementById('nutrientReference').addEventListener('change', function () {
            // Aqui você implementaria a lógica para reordenar as sugestões
            console.log('Nutriente de referência alterado:', this.value);
        });
    </script>
</body>

</html>