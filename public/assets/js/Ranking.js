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