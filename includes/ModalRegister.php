<!-- Modal de Registro -->
 
<div id="registerModal" class="modal">
    <div class="modal-content">
      <span class="close-modal" onclick="closeRegisterModal()">&times;</span>
      <h2>Cadastro</h2>
      <div id="registerMessage"></div>
      <form id="registerForm">
        <div class="form-group">
          <label for="registerNome">Nome</label>
          <input type="text" id="registerNome" name="nome" required />
        </div>
        <div class="form-group">
          <label for="registerSobrenome">Sobrenome</label>
          <input type="text" id="registerSobrenome" name="sobrenome" required />
        </div>
        <div class="form-group">
          <label for="registerEmail">E-mail</label>
          <input type="email" id="registerEmail" name="email" required />
        </div>
        <div class="form-group">
          <label for="registerSenha">Senha</label>
          <input type="password" id="registerSenha" name="senha" required />
        </div>
        <button type="submit">Cadastrar</button>
      </form>
      <p class="register-link">Já possui conta? <a href="javascript:void(0);" onclick="openLoginModal(); closeRegisterModal();">Faça login</a></p>
    </div>
  </div>
  
  <script>

    // Registro AJAX
document.addEventListener('DOMContentLoaded', function() {
  const registerModal = document.getElementById('registerModal');
  const registerForm = document.getElementById('registerForm');
  const registerMessage = document.getElementById('registerMessage');

  window.openRegisterModal = function () {
    registerModal.style.display = 'block';
  };

  window.closeRegisterModal = function () {
    registerModal.style.display = 'none';
  };

  window.addEventListener('click', function(event) {
    if (event.target === registerModal) {
      registerModal.style.display = 'none';
    }
  });

  registerForm?.addEventListener('submit', function(e) {
    e.preventDefault();

    const nome = document.getElementById('registerNome').value;
    const sobrenome = document.getElementById('registerSobrenome').value;
    const email = document.getElementById('registerEmail').value;
    const senha = document.getElementById('registerSenha').value;

    fetch('/NutriCalc/pages/login/RegisterAjax.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `nome=${encodeURIComponent(nome)}&sobrenome=${encodeURIComponent(sobrenome)}&email=${encodeURIComponent(email)}&senha=${encodeURIComponent(senha)}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        location.reload(); // Ou redirecione para login se preferir
      } else {
        registerMessage.innerHTML = `<p class="error">${data.message}</p>`;
      }
    })
    .catch(error => {
      registerMessage.innerHTML = '<p class="error">Erro ao processar o cadastro.</p>';
      console.error('Erro:', error);
    });
  });
});


  </script>
