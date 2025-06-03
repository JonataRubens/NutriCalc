 // Lógica do Modal de Login
            document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('loginModal');
            const loginForm = document.getElementById('loginForm');
            const loginMessage = document.getElementById('loginMessage');
            
            // Função para abrir o modal (você pode chamar isso de um botão de login na NavBar)
            window.openLoginModal = function() {
            modal.style.display = 'block';
            };
            
            // Fechar o modal quando clicar no X
            document.querySelector('.close-modal').addEventListener('click', function() {
            modal.style.display = 'none';
            });
            
            // Fechar o modal quando clicar fora dele
            window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
            });
            
            // Enviar o formulário via AJAX
            loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('modalEmail').value;
            const senha = document.getElementById('modalSenha').value;
            
            fetch('Urls.php?page=login', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${encodeURIComponent(email)}&senha=${encodeURIComponent(senha)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                // Login bem-sucedido - recarregar a página
                window.location.reload();
                } else {
                // Mostrar mensagem de erro
                loginMessage.innerHTML = `<p class="error">${data.message}</p>`;
                }
            })
            .catch(error => {
                loginMessage.innerHTML = '<p class="error">Erro ao processar o login.</p>';
                console.error('Erro:', error);
            });
            });
        });