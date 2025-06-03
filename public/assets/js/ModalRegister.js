
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

    fetch('Urls.php?page=register', {
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
