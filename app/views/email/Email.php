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
        <div class="faq-container">
            <h2 class="faq-title">Dúvidas Frequentes</h2>
            
            <div class="faq-item">
                <input type="checkbox" id="faq1" class="faq-toggle">
                <label for="faq1" class="faq-question">O que é IMC?</label>
                <div class="faq-answer">
                    <p>
                        IMC significa Índice de Massa Corporal. É um cálculo simples feito dividindo o peso (em kg) pela altura ao quadrado (em metros). Ele serve para indicar se você está dentro do peso ideal para sua altura.
                    </p>
                </div>
            </div>
            
            <div class="faq-item">
                <input type="checkbox" id="faq2" class="faq-toggle">
                <label for="faq2" class="faq-question">Como posso calcular meu IMC?</label>
                <div class="faq-answer">
                    <p>
                        Basta dividir seu peso (em kg) pela sua altura (em metros) ao quadrado. Exemplo: 70 ÷ (1,70 x 1,70) = 24,2.
                    </p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq-calorias" class="faq-toggle">
                <label for="faq-calorias" class="faq-question">Como é feita a medição de calorias?</label>
                <div class="faq-answer">
                    <p>
                        A medição de calorias é feita calculando a energia que os alimentos fornecem ao corpo. Geralmente, as calorias dos alimentos são informadas nos rótulos e podem ser somadas ao longo do dia para acompanhar o consumo total.
                    </p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq-agua" class="faq-toggle">
                <label for="faq-agua" class="faq-question">Qual a quantidade ideal de água por dia?</label>
                <div class="faq-answer">
                    <p>
                        A recomendação geral é consumir cerca de 2 litros (ou 8 copos) de água por dia, mas essa quantidade pode variar de acordo com o peso, idade, clima e nível de atividade física de cada pessoa.
                    </p>
                </div>
            </div>

            
            <div class="faq-item">
                <input type="checkbox" id="faq3" class="faq-toggle">
                <label for="faq3" class="faq-question">Para que serve o formulário de contato?</label>
                <div class="faq-answer">
                    <p>
                        Você pode usar o formulário para tirar dúvidas, enviar sugestões, relatar problemas ou propor parcerias.
                    </p>
                </div>
            </div>
        </div>

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