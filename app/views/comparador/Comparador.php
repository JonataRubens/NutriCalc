<?php include('../public/includes/NavBar.php'); ?>
<link rel="stylesheet" href="/assets/css/Comparador.css">
<main>
  <div class="form-container">
    <h2>Comparador Nutricional</h2>
    <p>Compare dois alimentos e veja as diferenças em calorias, proteínas, carboidratos e lipídios.</p>

    <form method="POST">
        <label for="alimento1">Primeiro alimento:</label>
        <div class="autocomplete-wrapper">
            <input type="text" id="alimento1" name="alimento1" autocomplete="off" required>
            <div id="sugestoes1" class="autocomplete-box"></div>
        </div>

        <label for="alimento2">Segundo alimento:</label>
        <div class="autocomplete-wrapper">
            <input type="text" id="alimento2" name="alimento2" autocomplete="off" required>
            <div id="sugestoes2" class="autocomplete-box"></div>
        </div>

      <datalist id="alimentos">
      <?php
      include __DIR__ . '/../../../public/includes/db_connection.php';
      $result = $conn->query("SELECT descricao FROM alimentos ORDER BY descricao");
      while ($row = $result->fetch_assoc()) {
        echo "<option value=\"{$row['descricao']}\">";
      }
      $conn->close();
      ?>
    </datalist>

    <button type="submit">Comparar</button>
  </form>

  
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alimento1 = $_POST['alimento1'];
    $alimento2 = $_POST['alimento2'];

    include __DIR__ . '/../../../public/includes/db_connection.php';

    $stmt = $conn->prepare("SELECT * FROM alimentos WHERE descricao = ? OR descricao = ?");
    $stmt->bind_param("ss", $alimento1, $alimento2);
    $stmt->execute();
    $result = $stmt->get_result();

    $dados = [];
    while ($row = $result->fetch_assoc()) {
      $dados[$row['descricao']] = $row;
    }
    $conn->close();

    if (isset($dados[$alimento1]) && isset($dados[$alimento2])) {
      $a = $dados[$alimento1];
      $b = $dados[$alimento2];

      function frase_comparativa($descA, $descB, $valA, $valB, $nutriente) {
  if ($valA == $valB) {
    return "<li><b>$descA</b> e <b>$descB</b> têm a mesma quantidade de $nutriente.</li>";
  }

  if ($valB == 0 && $valA > 0) {
    return "<li><b>$descA</b> tem infinitamente mais $nutriente que <b>$descB</b> (pois <b>$descB</b> tem 0g).</li>";
  }

  if ($valA == 0 && $valB > 0) {
    return "<li><b>$descA</b> não tem $nutriente, enquanto <b>$descB</b> tem <b>{$valB}g</b>.</li>";
  }

  $percent = round((($valA - $valB) / $valB) * 100, 1);

  if ($percent > 0) {
    return "<li><b>$descA</b> tem <b>{$percent}%</b> mais $nutriente que <b>$descB</b>.</li>";
  } else {
    return "<li><b>$descB</b> tem <b>" . abs($percent) . "%</b> mais $nutriente que <b>$descA</b>.</li>";
  }
}
      echo "<div class='resultado'>";
      echo "<h3>Dados</h3><ul>";
      echo frase_comparativa($a['descricao'], $b['descricao'], $a['energia'], $b['energia'], 'calorias');
      echo frase_comparativa($a['descricao'], $b['descricao'], $a['proteina'], $b['proteina'], 'proteínas');
      echo frase_comparativa($a['descricao'], $b['descricao'], $a['carboidratos'], $b['carboidratos'], 'carboidratos');
      echo frase_comparativa($a['descricao'], $b['descricao'], $a['lipideos'], $b['lipideos'], 'lipídios');
      echo "</ul></div>";
    } else {
      echo "<p>Alimento(s) não encontrado(s).</p>";
    }
  }
  ?>
</main>

<script src="/assets/js/Comparador.js"></script>

<?php include('../public/includes/Footer.html'); ?>
