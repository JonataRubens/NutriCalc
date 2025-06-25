<title>Ranking de Alimentos</title>
<link rel="stylesheet" href="/assets/css/Ranking.css">
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
        <input type="number" name="limite" id="limite" value="3" min="1" max="8">
        <button type="submit">Ir</button>
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
<script src="/assets/js/Ranking.js"></script>
</body>