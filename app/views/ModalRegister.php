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
<script src="/assets/js/ModalRegister.js"></script>