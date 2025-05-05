<?php include('../../includes/NavBar.php'); ?>
<main class="container">
<hr class="linha-divisoria">
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
                <a href="/pages/Ferramentas/PagCalcCalorias.php">Calcular calorias</a>
            </div>

            <div class="calc-card gratuito" style="border-left: 6px solid #ef4444;">
                <h4>Calculadora de IMC</h4>
                <p>Verifique se seu peso está adequado para sua altura com base no Índice de Massa Corporal.</p>
                <a href="/pages/Ferramentas/Imc.php">Calcular IMC</a>
            </div>

            <div class="calc-card gratuito" style="border-left: 6px solid rgb(136, 41, 199);">
                <h4 >Calculadora de Gasto calorico</h4>
                <p>Saiba quantas calorias seu corpo gasta por dia com base em informações simples.</p>
                <a href="/pages/Ferramentas/CalcCalorias.php">Calcular Gasto calorias</a>
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

<?php include('../../includes/Footer.html'); ?>
