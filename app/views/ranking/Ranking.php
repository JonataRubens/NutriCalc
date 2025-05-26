<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ranking de Alimentos</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6fb;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #2d3a4b;
            margin-top: 30px;
        }
        form#ranking-form {
            background: #fff;
            max-width: 600px;
            margin: 30px auto 20px auto;
            padding: 24px 32px 16px 32px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(44,62,80,0.08);
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            align-items: center;
            justify-content: center;
        }
        form#ranking-form label {
            font-weight: 500;
            color: #2d3a4b;
        }
        form#ranking-form select, form#ranking-form input[type="number"] {
            padding: 7px 10px;
            border-radius: 6px;
            border: 1px solid #bfc9d1;
            font-size: 15px;
            background: #f8fafc;
            color: #2d3a4b;
        }
        form#ranking-form button {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 22px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }
        form#ranking-form button:hover {
            background: #0056b3;
        }
        #ranking-table {
            width: 90%;
            margin: 0 auto 40px auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(44,62,80,0.08);
            overflow: hidden;
        }
        #ranking-table th, #ranking-table td {
            padding: 14px 10px;
            text-align: center;
        }
        #ranking-table th {
            background: #007bff;
            color: #fff;
            font-weight: 600;
            font-size: 16px;
        }
        #ranking-table tr:nth-child(even) {
            background: #f4f6fb;
        }
        #ranking-table tr:hover {
            background: #e3eefd;
        }
        @media (max-width: 700px) {
            form#ranking-form {
                flex-direction: column;
                padding: 18px 8px 10px 8px;
            }
            #ranking-table {
                font-size: 13px;
            }
        }
    </style>
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