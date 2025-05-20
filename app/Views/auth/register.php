<?php include __DIR__ . '/../partials/navbar.php'; ?>
<main class="container">
    <h2>Cadastro</h2>
    <form method="post" action="/Auth/register">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <button type="submit">Cadastrar</button>
    </form>
    <p>Já tem conta? <a href="/Auth/login">Entrar</a></p>
</main>
<?php include __DIR__ . '/../partials/footer.php'; ?>
