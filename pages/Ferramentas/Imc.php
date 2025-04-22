<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>IMC</title>
    <link rel="stylesheet" href="../../assets/css/Imc.css">
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
  
     <!-- IMC -->
    <div class="container">
    <h2>Calculadora de IMC</h2>
    <p>Verifique se seu peso está adequado para sua altura com base no Índice de Massa Corporal.</p>
    
    <form id="imcForm">
      <div class="input-group">
        <label for="altura">Altura (cm)</label>
        <input type="number" id="altura" required />
      </div>
      <div class="input-group">
        <label for="peso">Peso (kg)</label>
        <input type="number" id="peso" required />
      </div>
      <button type="submit">Calcular IMC</button>
    </form>

    <div id="resultado" class="resultado"></div>
  </div>
   
  <hr class="linha-divisoria">
  
  <!-- Script para calcular o IMC -->
  <script>
    const form = document.getElementById("imcForm");
    const resultado = document.getElementById("resultado");

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      const altura = parseFloat(document.getElementById("altura").value) / 100;
      const peso = parseFloat(document.getElementById("peso").value);

      if (altura > 0 && peso > 0) {
        const imc = (peso / (altura * altura)).toFixed(2);
        let classificacao = "";

        if (imc < 18.5) {
          classificacao = "Abaixo do peso";
        } else if (imc < 24.9) {
          classificacao = "Peso normal";
        } else if (imc < 29.9) {
          classificacao = "Sobrepeso";
        } else if (imc < 34.9) {
          classificacao = "Obesidade grau 1";
        } else if (imc < 39.9) {
          classificacao = "Obesidade grau 2";
        } else {
          classificacao = "Obesidade grau 3";
        }

        resultado.textContent = `Seu IMC é ${imc} (${classificacao}).`;
      } else {
        resultado.textContent = "Preencha os campos corretamente.";
      }
    });
  </script>
    
    <!-- Calculadoras -->
    <h3>Conheça nossas Ferramentas Nutricionais</h3>
    <section class="calculadoras">
            <div class="calc-card gratuito" style="border-left: 6px solid #06b6d4;">
                <h4 >Calculadora de Calorias</h4>
                <p>Descubra quantas calorias e nutrientes você consome ao montar suas refeições diárias.</p>
                <a href="#">Calcular calorias</a>
            </div>

  
            <div class="calc-card gratuito" style="border-left: 6px solid #facc15;">
                <h4>Calculadora de Ingestao de agua</h4>
                <p>Verifique se esta ingerindo a quantide de agua correta para a sua idade e peso.</p>
                <a href="QTDAagua.php">Calculadora ingestao de agua</a>
            </div>

        </section>

        <hr class="linha-divisoria">
        
        
        
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


</header>
</body>
</html>