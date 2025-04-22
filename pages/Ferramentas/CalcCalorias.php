<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Calculadora de Gasto Calórico</title>
    <link rel="stylesheet" href="../../assets/css/Style.css" />
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

    <hr class="linha-divisoria" />

    <div class="container-GCalor">
        <div class="calorico-wrapper"></div>
      <h1>Calculadora de Gasto Calórico</h1>
       <p>A calculadora de gasto calórico é importante para entender quantas calorias seu corpo gasta diariamente, ajudando em objetivos de perda de peso, manutenção ou ganho de massa..</p>
      <div class="form-group-GCalor">
        <div class="form-control">
          <label>Sexo</label>
          <div class="sexo_bts_Gcalorico">
            <button type="button" onclick="selectSexo(this, 'male')">
              Homem
            </button>
            <button type="button" onclick="selectSexo(this, 'female')">
              Mulher
            </button>
          </div>
        </div>
        <div class="form-control">
          <label>Idade</label>
          <input type="number" id="idade" placeholder="25 anos" />
        </div>
        <div class="form-control">
          <label>Altura (cm)</label>
          <input type="number" id="altura" placeholder="170" />
        </div>
        <div class="form-control">
          <label>Peso (kg)</label>
          <input type="number" id="peso" placeholder="65" />
        </div>
        <div class="form-control">
          <label>Exercício físico</label>
          <select id="atividade">
            <option value="">Selecione uma opção</option>
            <option value="1.2">Sedentário</option>
            <option value="1.375">Levemente ativo</option>
            <option value="1.55">Moderadamente ativo</option>
            <option value="1.725">Muito ativo</option>
            <option value="1.9">Extremamente ativo</option>
          </select>
        </div>
        <div class="form-control">
          <label>Objetivo</label>
          <select id="objetivo">
            <option value="">Selecione uma opção</option>
            <option value="deficit">Perder peso</option>
            <option value="manter">Manter peso</option>
            <option value="excedente">Ganhar massa</option>
          </select>
        </div>
      </div>
      <button onclick="calcularGasto()">Calcular Gasto Calórico</button>

      <div
        class="resultado_GCalor"
        id="resultado_GCalor"
        style="display: none"
      ></div>
    </div>

      <hr class="linha-divisoria" />

      <!-- Calculadoras -->
      <h3>Conheça nossas Ferramentas Nutricionais</h3>
      <section class="calculadoras">
        <div class="calc-card gratuito" style="border-left: 6px solid #06b6d4">
          <h4>Calculadora de Calorias</h4>
          <p>
            Descubra quantas calorias e nutrientes você consome ao montar suas
            refeições diárias.
          </p>
          <a href="#">Calcular calorias</a>
        </div>

        <div class="calc-card gratuito" style="border-left: 6px solid #ef4444">
          <h4>Calculadora de IMC</h4>
          <p>
            Verifique se seu peso está adequado para sua altura com base no
            Índice de Massa Corporal.
          </p>
          <a href="#">Calcular IMC</a>
        </div>
      </section>
    </main>

    <script>
      let sexo = null;

      function selectSexo(button, value) {
        document
          .querySelectorAll(".sexo_bts_Gcalorico button")
          .forEach((btn) => btn.classList.remove("active"));
        button.classList.add("active");
        sexo = value;
      }

      function calcularGasto() {
        const idade = parseInt(document.getElementById("idade").value);
        const altura = parseFloat(document.getElementById("altura").value);
        const peso = parseFloat(document.getElementById("peso").value);
        const atividade = parseFloat(
          document.getElementById("atividade").value
        );
        const objetivo = document.getElementById("objetivo").value;
        const resultado_GCalorDiv = document.getElementById("resultado_GCalor");

        if (!sexo || !idade || !altura || !peso || !atividade || !objetivo) {
          resultado_GCalorDiv.style.display = "block";
          resultado_GCalorDiv.style.backgroundColor = "#fff5f5";
          resultado_GCalorDiv.style.border = "1px solid #fed7d7";
          resultado_GCalorDiv.style.color = "#c53030";
          resultado_GCalorDiv.textContent =
            "Por favor, preencha todos os campos.";
          return;
        }

        let bmr;
        if (sexo === "male") {
          bmr = 10 * peso + 6.25 * altura - 5 * idade + 5;
        } else {
          bmr = 10 * peso + 6.25 * altura - 5 * idade - 161;
        }

        const tdee = bmr * atividade;
        let resultado_GCalorTexto = `Seu gasto calórico diário estimado é de ${Math.round(
          tdee
        )} calorias.`;

        if (objetivo === "deficit") {
          resultado_GCalorTexto += ` Para perder peso, consuma cerca de ${Math.round(
            tdee - 500
          )} calorias por dia.`;
        } else if (objetivo === "excedente") {
          resultado_GCalorTexto += ` Para ganhar massa, consuma cerca de ${Math.round(
            tdee + 500
          )} calorias por dia.`;
        } else {
          resultado_GCalorTexto += ` Para manter o peso, continue com esse consumo.`;
        }

        resultado_GCalorDiv.style.display = "block";
        resultado_GCalorDiv.style.backgroundColor = "#f0fff4";
        resultado_GCalorDiv.style.border = "1px solid #c6f6d5";
        resultado_GCalorDiv.style.color = "#2f855a";
        resultado_GCalorDiv.textContent = resultado_GCalorTexto;
      }
    </script>
  </body>

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

</html>