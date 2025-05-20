<?php include('../../includes/NavBar.php'); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calculadora de Primeiro Ciclo</title>
  <link rel="stylesheet" href="/assets/css/Monstro.css" />
  <style>
    .anabo-resultado {
      margin-top: 25px;
      padding: 15px;
      background-color: #f9f9f9;
      border-left: 4px solid #000;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <main>
    <div class="anabo-container">
      <form class="anabo-formulario" method="POST">
        <h2>Calculadora do Primeiro Ciclo</h2>
        <p>Descubra se você está apto para iniciar um ciclo hormonal e receba orientações iniciais com base em dados simples.</p>

        <div class="anabo-sexo">
          <input type="radio" id="sexo-homem" name="sexo" value="Homem" required />
          <label for="sexo-homem">Homem</label>

          <input type="radio" id="sexo-mulher" name="sexo" value="Mulher" />
          <label for="sexo-mulher">Mulher</label>
        </div>

        <input type="number" name="idade" placeholder="Idade" required />
        <input type="number" name="altura" placeholder="Altura (cm)" required />
        <input type="number" name="peso" placeholder="Peso (kg)" required />
        <input type="number" name="gordura" placeholder="Percentual de gordura (%)" required />

        <select name="atividade" required>
          <option selected disabled>Nível de atividade física</option>
          <option value="Sedentário">Sedentário</option>
          <option value="Leve">Leve</option>
          <option value="Moderado">Moderado</option>
          <option value="Intenso">Intenso</option>
        </select>

        <select name="anabolizante" required>
          <option selected disabled>Selecione um anabolizante</option>
          <option value="Enantato de Testosterona">Enantato de Testosterona</option>
          <option value="Durateston">Durateston</option>
          <option value="Oxandrolona">Oxandrolona</option>
          <option value="Stanozolol">Stanozolol</option>
          <option value="Deca Durabolin">Deca Durabolin</option>
          <option value="Primobolan">Primobolan</option>
          <option value="Boldenona">Boldenona</option>
          <option value="Trembolona">Trembolona</option>
        </select>

        <button type="submit">Calcular ciclo</button>
      </form>

      <!-- RESULTADO APARECE APENAS DEPOIS DO SUBMIT -->
      <div class="anabo-resultado" style="<?php echo ($_SERVER['REQUEST_METHOD'] === 'POST') ? 'display:block;' : 'display:none;'; ?>">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $sexo = $_POST['sexo'] ?? null;
          $idade = isset($_POST['idade']) ? (int) $_POST['idade'] : null;
          $altura = isset($_POST['altura']) ? (int) $_POST['altura'] : null;
          $peso = isset($_POST['peso']) ? (float) $_POST['peso'] : null;
          $gordura = isset($_POST['gordura']) ? (float) $_POST['gordura'] : null;
          $atividade = $_POST['atividade'] ?? null;
          $anabolizante = $_POST['anabolizante'] ?? null;

          if (!$sexo || !$idade || !$altura || !$peso || !$gordura || !$atividade || !$anabolizante) {
            echo "<p style='color:red;'>Por favor, preencha todos os campos corretamente.</p>";
          } else {
            $tmb = $sexo === 'Homem'
              ? 10 * $peso + 6.25 * $altura - 5 * $idade + 5
              : 10 * $peso + 6.25 * $altura - 5 * $idade - 161;

            $fator_atividade = match($atividade) {
              'Sedentário' => 1.2,
              'Leve' => 1.375,
              'Moderado' => 1.55,
              'Intenso' => 1.725,
              default => 1.2
            };

            $calorias = $tmb * $fator_atividade + 500;
            $recomendado = ($gordura < 18 && $atividade !== 'Sedentário');
            $dose_min = 250;
            $dose_max = 500;
            $semanas = 8;
            $ampolas = ceil($dose_max * $semanas / 250);
            $custo_medio = 30 * $ampolas;

            echo "<h3>Resultado:</h3>";
            echo "<p>Calorias ideais por dia: <strong>" . round($calorias) . " kcal</strong></p>";
            echo "<p>Status: <strong>" . ($recomendado ? "Apto para o ciclo" : "Não recomendado iniciar agora") . "</strong></p>";
            echo "<p>Anabolizante selecionado: <strong>{$anabolizante}</strong></p>";
            echo "<p>Dose semanal sugerida: <strong>{$dose_min}–{$dose_max} mg</strong></p>";
            echo "<p>Duração do ciclo: <strong>{$semanas} semanas</strong></p>";
            echo "<p>Estimativa de ganho muscular: <strong>4–7 kg</strong></p>";
            echo "<p>Quantidade de ampolas: <strong>{$ampolas}</strong></p>";
            echo "<p>Custo estimado do ciclo: <strong>R$ {$custo_medio},00</strong></p>";

            echo "<p><strong>Benefícios:</strong> aumento de massa magra, força e recuperação.</p>";
            echo "<p><strong>Malefícios:</strong> acne, ginecomastia, queda de cabelo, alterações hormonais, risco hepático e cardiovascular.</p>";
            echo "<p><strong>Aviso:</strong> Consulte sempre um profissional da saúde antes de iniciar qualquer protocolo hormonal.</p>";
          }
        }
        ?>
      </div>
    </div>
  </main>
</body>
</html>


































<?php include('../../includes/Footer.html'); ?>