<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
   echo "<script>
            alert('Recurso disponível apenas para usuários logados.');
            window.close();
          </script>";
    exit();
}

use Dompdf\Dompdf;
require_once './autoload.inc.php';

$dompdf = new Dompdf();

// Captura os dados enviados
$nome = $_POST['nome'] ?? 'Marcus Vinicius';
$sexo = $_POST['sexo'] ?? 'Masculino';
$idade = $_POST['idade'] ?? '24';
$peso = $_POST['peso'] ?? '90';
$altura = $_POST['altura'] ?? '176';
$atividade = $_POST['atividade'] ?? 'moderado';
$total_calorias = $_POST['total_calorias'] ?? '2752';
$carboidratos = $_POST['carboidratos'] ?? '110';
$proteinas = $_POST['proteinas'] ?? '260';
$lipideos = $_POST['lipideos'] ?? '90';
$resultado_detalhado = nl2br($_POST['resultado_detalhado'] ?? 'sobrepeso');

// Descrição da atividade
$atividadeDescricao = [
    "1.2" => "Sedentário",
    "1.375" => "Levemente ativo",
    "1.55" => "Moderadamente ativo",
    "1.725" => "Muito ativo",
    "1.9" => "Extremamente ativo",
][$atividade] ?? "Não informado";

// Monta o conteúdo do PDF
$html = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            line-height: 1.6;
        }
        h1 {
            color: #4caf50;
            text-align: center;
            margin-bottom: 20px;
        }
        .info-container, .result-container, .detail-container {
            border: 2px solid #4caf50;
            padding: 15px;
            border-radius: 8px;
            background-color: #f4f4f4;
            margin-bottom: 20px;
        }
        .info-item, .result-item, .detail-item {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .info-value, .result-value, .detail-value {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Relatório Nutricional</h1>
    <div class='info-container'>
        <div class='info-item'>Nome do Usuário: <span class='info-value'>{$nome}</span></div>
        <div class='info-item'>Sexo: <span class='info-value'>{$sexo}</span></div>
        <div class='info-item'>Idade: <span class='info-value'>{$idade} anos</span></div>
        <div class='info-item'>Peso: <span class='info-value'>{$peso} kg</span></div>
        <div class='info-item'>Altura: <span class='info-value'>{$altura} cm</span></div>
        <div class='info-item'>Nível de Atividade: <span class='info-value'>{$atividadeDescricao}</span></div>
    </div>

    <div class='result-container'>
        <div class='result-item'>Total de Calorias: <span class='result-value'>{$total_calorias} calorias</span></div>
        <div class='result-item'>Carboidratos: <span class='result-value'>{$carboidratos} g</span></div>
        <div class='result-item'>Proteínas: <span class='result-value'>{$proteinas} g</span></div>
        <div class='result-item'>Lipídeos: <span class='result-value'>{$lipideos} g</span></div>
    </div>

    <div class='detail-container'>
        <h2>Detalhes das Refeições</h2>
        <div class='detail-item'>{$resultado_detalhado}</div>
    </div>
</body>
</html>
";

// Carrega o HTML no Dompdf
$dompdf->load_html($html);

// Define as configurações do PDF
$dompdf->set_option('defaultFont','sans');
$dompdf->set_paper('A4','portrait');

// Gera o PDF
$dompdf->render();

// Envia o PDF para o navegador
$dompdf->stream("Relatorio_Nutricional.pdf", ["Attachment" => 0]);
?>
