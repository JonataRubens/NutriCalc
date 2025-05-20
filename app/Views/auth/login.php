<?php include __DIR__ . '/../partials/navbar.php'; ?>
<main class="container">
    <h2>Login</h2>
    <form method="post" action="/Auth/login">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem conta? <a href="/Auth/register">Cadastre-se</a></p>
</main>
<?php include __DIR__ . '/../partials/footer.php'; ?>
