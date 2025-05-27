<?php include('../public/includes/NavBar.php'); ?>
<main class="container">
<hr class="linha-divisoria">
    <div class="agua-wrapper">
      <h1>Calculadora de IMC</h1>
      <p>Saiba se o seu peso esta ideal com a sua altura</p>

      <form id="formIMC">
        <div class="agua-inputs">
          <div>
            <label for="idade">Altura(cm)</label>
            <input type="number" id="altura" placeholder="170cm" required>
          </div>
          <div>
            <label for="peso">Peso (kg)</label>
            <input type="number" id="peso" placeholder="65" required>
          </div>
        </div>
        <button type="submit" class="agua-btn">Calcular IMC</button>
      </form>

      <div class="agua-resultado" id="resultadoIMC"></div>
    </div>

    <hr class="linha-divisoria">

    <!-- Calculadoras -->
    <h3>Conheça nossas Ferramentas Nutricionais</h3>
    <section class="calculadoras">
            <div class="calc-card gratuito" style="border-left: 6px solid #06b6d4;">
                <h4 >Calculadora de Calorias</h4>
                <p>Descubra quantas calorias e nutrientes você consome ao montar suas refeições diárias.</p>
                <a href="/pages/Ferramentas/PagCalcCalorias.php">Calcular calorias</a>
            </div>

            <div class="calc-card gratuito" style="border-left: 6px solid rgb(239, 213, 68);">
                <h4>Calculadora de Consumo de agua</h4>
                <p>Verifique se seu consumo de agua esta adeguado com a sua idade e peso.</p>
                <a href="/pages/Ferramentas/QTDAagua.php">Calculadora de Consumo de agua </a>
            </div>

            <div class="calc-card gratuito" style="border-left: 6px solid rgb(136, 41, 199);">
                <h4 >Calculadora de Gasto calorico</h4>
                <p>Saiba quantas calorias seu corpo gasta por dia com base em informações simples.</p>
                <a href="/pages/Ferramentas/CalcCalorias.php">Calcular Gasto calorias</a>
            </div>

        </section>
  </main>

  <script>
  const form = document.getElementById('formIMC');
  const resultado = document.getElementById('resultadoIMC');

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    
    const peso = parseFloat(document.getElementById('peso').value);
    const alturaCm = parseFloat(document.getElementById('altura').value);

    if (isNaN(peso) || isNaN(alturaCm) || peso <= 0 || alturaCm <= 0) {
      resultado.textContent = "Preencha todos os campos corretamente.";
      return;
    }

    const alturaM = alturaCm / 100;
    const imc = peso / (alturaM * alturaM);

    let classificacao = '';

    if (imc < 18.5) {
      classificacao = 'Abaixo do peso';
    } else if (imc < 24.9) {
      classificacao = 'Peso normal';
    } else if (imc < 29.9) {
      classificacao = 'Sobrepeso';
    } else if (imc < 34.9) {
      classificacao = 'Obesidade Grau 1';
    } else if (imc < 39.9) {
      classificacao = 'Obesidade Grau 2';
    } else {
      classificacao = 'Obesidade Grau 3';
    }

    resultado.innerHTML = `Seu IMC é <strong>${imc.toFixed(2)}</strong> (${classificacao}).`;
  });
</script>


</body>
<?php include('../public/includes/Footer.html'); ?>
