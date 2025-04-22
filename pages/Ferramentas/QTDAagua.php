<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Calculadora de Água</title>
  <link rel="stylesheet" href="../../assets/css/Style.css">
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
    <div class="agua-wrapper">
      <h1>Calculadora de consumo diário de água</h1>
      <p>Saiba quantos litros de água você deve beber por dia com base no seu peso corporal.</p>

      <form id="formAgua">
        <div class="agua-inputs">
          <div>
            <label for="idade">Idade</label>
            <input type="number" id="idade" placeholder="25" required>
          </div>
          <div>
            <label for="peso">Peso (kg)</label>
            <input type="number" id="peso" placeholder="65" required>
          </div>
        </div>
        <button type="submit" class="agua-btn">Calcular consumo de água</button>
      </form>

      <div class="agua-resultado" id="resultadoAgua"></div>
    </div>

    <hr class="linha-divisoria">

    <!-- Calculadoras -->
    <h3>Conheça nossas Ferramentas Nutricionais</h3>
    <section class="calculadoras">
            <div class="calc-card gratuito" style="border-left: 6px solid #06b6d4;">
                <h4 >Calculadora de Calorias</h4>
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
    const form = document.getElementById('formAgua');
    const resultado = document.getElementById('resultadoAgua');

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const peso = parseFloat(document.getElementById('peso').value);

      if (isNaN(peso) || peso <= 0) {
        resultado.textContent = "Insira um peso válido.";
        return;
      }

      const consumoMl = peso * 35;
      const consumoLitros = (consumoMl / 1000).toFixed(2);

      resultado.innerHTML = `Você deve consumir aproximadamente <strong>${consumoMl.toFixed(0)} ml</strong> ou <strong>${consumoLitros} litros</strong> de água por dia.`;
    });
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
