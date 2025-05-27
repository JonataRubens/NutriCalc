<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ranking de Alimentos</title>
    <link rel="stylesheet" href="/assets/css/Ranking.css">

</head>
<body>
    <h1>Ranking de Alimentos</h1>
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
<script>
document.getElementById('ranking-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let filtro = document.getElementById('filtro').value;
    let ordem = document.getElementById('ordem').value;
    let limite = parseInt(document.getElementById('limite').value);

    fetch('/api/Alimentos.php')
        .then(res => res.json())
        .then(data => {
            // Ordena os dados conforme o filtro e ordem
            data.sort((a, b) => {
                if (ordem === 'asc') {
                    return parseFloat(a[filtro]) - parseFloat(b[filtro]);
                } else {
                    return parseFloat(b[filtro]) - parseFloat(a[filtro]);
                }
            });
            // Limita a quantidade
            data = data.slice(0, limite);

            let tbody = document.querySelector('#ranking-table tbody');
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
        });
});

// Carregar ranking padrão ao abrir a página
document.getElementById('ranking-form').dispatchEvent(new Event('submit'));
</script>
</body>
</html>