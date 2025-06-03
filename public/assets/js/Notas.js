function openModal(titulo, resumo, completo, id) {
    document.getElementById("modalTitulo").innerText = titulo;
    document.getElementById("modalConteudo").innerHTML = completo;
    document.getElementById("notaIdParaExcluir").value = id;
    document.getElementById("btnEditar").href = `/Urls.php?page=edit-notas&id=${id}`;
    document.getElementById("notaModal").style.display = "block";
}

function closeModal() {
    document.getElementById("notaModal").style.display = "none";
}