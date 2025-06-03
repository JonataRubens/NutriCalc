<?php 
include(__DIR__ . '/../../../public/includes/NavBar.php');

// Lógica para envio de e-mail
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = str_replace(["\r", "\n"], '', trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $reason = trim($_POST['reason'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (
        !empty($name) && 
        !empty($email) && 
        !empty($reason) && 
        !empty($message) &&
        filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        $to = 'test@test.com';
        $subject = "Contato via site: $reason";
        $body = "Nome: $name\nEmail: $email\nMotivo: $reason\nMensagem:\n$message";
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $subject, $body, $headers)) {
            $success = true;
        } else {
            $error = "Não foi possível enviar sua mensagem. Tente novamente mais tarde.";
            // Opcional: error_log(print_r(error_get_last(), true));
        }
    } else {
        $error = "Preencha todos os campos corretamente.";
    }
}
?>

<link rel="stylesheet" href="/assets/css/Email.css">
<main>
            <div class="form-container">
            <h1 class="form-title">Entre em Contato</h1>

            <?php if (isset($success) && $success): ?>
                <div class="alert success">Mensagem enviada com sucesso! Entraremos em contato em breve.</div>
            <?php elseif (isset($error)): ?>
                <div class="alert error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <form action="" method="POST" id="contactForm">
                <div class="form-group">
                    <label for="name">Nome *</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        required 
                        placeholder="Digite seu nome completo"
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required 
                        placeholder="seu@email.com"
                    >
                </div>

                <div class="form-group">
                    <label for="reason">Motivo do Contato *</label>
                    <select id="reason" name="reason" required>
                        <option value="">Selecione um motivo</option>
                        <option value="duvida">Dúvidas</option>
                        <option value="suporte">Suporte/Bugs</option>
                        <option value="sugestao">Sugestão</option>
                        <option value="reclamacao">Reclamação</option>
                        <option value="parceria">Proposta de parceria</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Mensagem *</label>
                    <textarea 
                        id="message" 
                        name="message" 
                        required 
                        placeholder="Descreva sua mensagem aqui..."
                    ></textarea>
                </div>

                <button type="submit" class="submit-btn">
                    Enviar Mensagem
                </button>
            </form>
        </div>
</main>
<?php include(__DIR__ . '/../../../public/includes/Footer.html'); ?>