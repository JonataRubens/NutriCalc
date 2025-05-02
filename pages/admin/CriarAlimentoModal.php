<!-- Modal de Criar Alimento -->
<div id="createAlimentoModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeCreateModal()">&times;</span>
        <h2>Criar Novo Alimento</h2>
        <form method="POST">
            <input type="hidden" name="action" value="create">
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <input type="text" id="categoria" name="categoria" required>
            </div>
            <div class="form-group">
                <label for="energia">Energia (kcal)</label>
                <input type="number" id="energia" name="energia" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="proteina">Proteína (g)</label>
                <input type="number" id="proteina" name="proteina" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="lipideos">Lipídios (g)</label>
                <input type="number" id="lipideos" name="lipideos" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="carboidratos">Carboidratos (g)</label>
                <input type="number" id="carboidratos" name="carboidratos" step="0.01" required>
            </div>
            <button type="submit">Criar</button>
        </form>
    </div>
</div>
