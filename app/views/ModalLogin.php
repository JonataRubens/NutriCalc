     <!-- Modal de Login -->
     <div id="loginModal" class="modal">
        <div class="modal-content">
          <span class="close-modal">&times;</span>
          <h2>Login</h2>
          <div id="loginMessage"></div>
          <form id="loginForm">
            <div class="form-group">
              <label for="modalEmail">E-mail</label>
              <input type="email" id="modalEmail" name="email" required />
            </div>
            <div class="form-group">
              <label for="modalSenha">Senha</label>
              <input type="password" id="modalSenha" name="senha" required />
            </div>
            <button type="submit">Entrar</button>
          </form>
          <p class="register-link">Não possui conta? <a href="javascript:void(0);" onclick="openRegisterModal(); closeLoginModal();">Crie uma conta</a></p>
        </div>
      </div>
    <script src="/assets/js/ModalLogin.js"></script>
