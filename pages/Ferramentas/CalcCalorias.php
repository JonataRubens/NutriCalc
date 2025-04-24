<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Calculadora de Gasto Calórico</title>
  <link rel="stylesheet" href="../../assets/css/Style.css">
  <link rel="stylesheet" href="../../assets/css/Calorias.css">
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="container">
      <nav>
        <ul>
          <li><a href="../../index.php">Página inicial</a></li>
          <li><a href="../Calculadoras.php">Ferramentas Nutricionais</a></li>
          <li><a href="../Blog.php">Blog</a></li>
        </ul>
        <div class="nav-right">
          <a href="#" class="btn-entrar">Entrar</a>
          <a href="../Register.html" class="btn-criar">Criar Conta</a>
        </div>
      </nav>
    </div>
  </header>

  <hr class="linha-divisoria">

  <main class="container">
    <div class="calorico-wrapper">
      <h1>Calculadora de Gasto Calórico</h1>
      <p>Saiba quantas calorias seu corpo gasta por dia com base em informações simples.</p>

      <form id="formCalorico">
        <div class="form-control">
          <label>Sexo</label>
          <div class="sexo_bts_Gcalorico">
            <button type="button" onclick="selectSexo(this, 'male')">Homem</button>
            <button type="button" onclick="selectSexo(this, 'female')">Mulher</button>
          </div>
        </div>

        <div class="form-control">
          <label for="idade">Idade</label>
          <input type="number" id="idade" placeholder="25" required>
        </div>

        <div class="form-control">
          <label for="altura">Altura (cm)</label>
          <input type="number" id="altura" placeholder="170" required>
        </div>

        <div class="form-control">
          <label for="peso">Peso (kg)</label>
          <input type="number" id="peso" placeholder="65" required>
        </div>

        <div class="form-control">
          <label for="atividade">Nível de atividade física</label>
          <select id="atividade" required>
            <option value="">Selecione</option>
            <option value="1.2">Sedentário</option>
            <option value="1.375">Levemente ativo</option>
            <option value="1.55">Moderadamente ativo</option>
            <option value="1.725">Muito ativo</option>
            <option value="1.9">Extremamente ativo</option>
          </select>
        </div>

        <div class="form-control">
          <label for="objetivo">Objetivo</label>
          <select id="objetivo" required>
            <option value="">Selecione</option>
            <option value="deficit">Perder peso</option>
            <option value="manter">Manter peso</option>
            <option value="excedente">Ganhar massa</option>
          </select>
        </div>

        <button type="submit" class="agua-btn">Calcular gasto calórico</button>
      </form>

      <div class="agua-resultado" id="resultado_GCalor"></div>
    </div>

    <hr class="linha-divisoria">

    <!-- Calculadoras -->
    <h3>Conheça nossas Ferramentas Nutricionais</h3>
    <section class="calculadoras">
      <div class="calc-card gratuito" style="border-left: 6px solid #06b6d4;">
        <h4>Calculadora de Calorias</h4>
        <p>Descubra quantas calorias e nutrientes você consome ao montar suas refeições diárias.</p>
        <a href="#">Calcular calorias</a>
      </div>

      <div class="calc-card gratuito" style="border-left: 6px solid #ef4444;">
        <h4>Calculadora de IMC</h4>
        <p>Verifique se seu peso está adequado para sua altura com base no Índice de Massa Corporal.</p>
        <a href="#">Calcular IMC</a>
      </div>
    </section>
  </main>

  <script>
    let sexo = null;

    function selectSexo(button, value) {
      document.querySelectorAll(".sexo_bts_Gcalorico button").forEach((btn) => btn.classList.remove("active"));
      button.classList.add("active");
      sexo = value;
    }

    document.getElementById('formCalorico').addEventListener('submit', function(e) {
      e.preventDefault();

      const idade = parseInt(document.getElementById("idade").value);
      const altura = parseFloat(document.getElementById("altura").value);
      const peso = parseFloat(document.getElementById("peso").value);
      const atividade = parseFloat(document.getElementById("atividade").value);
      const objetivo = document.getElementById("objetivo").value;
      const resultado_GCalorDiv = document.getElementById("resultado_GCalor");

      if (!sexo || !idade || !altura || !peso || !atividade || !objetivo) {
        resultado_GCalorDiv.style.color = "#c53030";
        resultado_GCalorDiv.innerHTML = "Por favor, preencha todos os campos corretamente.";
        return;
      }

      let bmr = sexo === "male"
        ? 10 * peso + 6.25 * altura - 5 * idade + 5
        : 10 * peso + 6.25 * altura - 5 * idade - 161;

      const tdee = bmr * atividade;
      let texto = `Seu gasto calórico diário estimado é de <strong>${Math.round(tdee)} calorias</strong>. `;

      if (objetivo === "deficit") {
        texto += `Para perder peso, consuma cerca de <strong>${Math.round(tdee - 500)}</strong> calorias por dia.`;
      } else if (objetivo === "excedente") {
        texto += `Para ganhar massa, consuma cerca de <strong>${Math.round(tdee + 500)}</strong> calorias por dia.`;
      } else {
        texto += `Para manter o peso, continue com esse consumo.`;
      }

      resultado_GCalorDiv.style.color = "#2f855a";
      resultado_GCalorDiv.innerHTML = texto;
    });
  </script>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <h4>NutriCalc</h4>
          <p>Plataforma de apoio nutricional completa para usuários comuns.</p>
        </div>
        <div class="footer-col">
          <h4>Links rápidos</h4>
          <ul>
            <li><a href="../../index.php">Página inicial</a></li>
            <li><a href="../Calculadoras.php">Ferramentas Nutricionais</a></li>
            <li><a href="../Blog.php">Blog</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Contato</h4>
          <p>Email: nutricalc</p>
          <p>Suporte: snutricalc</p>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 NutriCalc. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>

</body>
</html>
