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

// Pega o nome do usuário da sessão
$usuario_nome = $_SESSION['usuario_nome'] ?? 'Usuário não identificado';

// Remove espaços e caracteres especiais para o nome do arquivo
$nome_arquivo = preg_replace('/[^a-zA-Z0-9_-]/', '_', $usuario_nome);

// Caminho correto para o autoload do Composer
require_once __DIR__ . '/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Pega os dados do POST
$sexo = $_POST['sexo'] ?? '';
$idade = $_POST['idade'] ?? '';
$altura = $_POST['altura'] ?? '';
$peso = $_POST['peso'] ?? '';
$gordura = $_POST['gordura'] ?? '';
$atividade = $_POST['atividade'] ?? '';
$anabolizante = $_POST['anabolizante'] ?? '';

$calorias = $_POST['calorias'] ?? '';
$status = $_POST['status'] ?? '';
$dose_min = $_POST['dose_min'] ?? '';
$dose_max = $_POST['dose_max'] ?? '';
$semanas = $_POST['semanas'] ?? '';
$ampolas = $_POST['ampolas'] ?? '';
$custo = $_POST['custo'] ?? '';

// Conteúdo HTML do PDF
$html = "
  <h1>Relatório do Primeiro Ciclo</h1>
  <h3>Usuário: {$usuario_nome}</h3>
  <p><strong>Sexo:</strong> {$sexo}</p>
  <p><strong>Idade:</strong> {$idade} anos</p>
  <p><strong>Altura:</strong> {$altura} cm</p>
  <p><strong>Peso:</strong> {$peso} kg</p>
  <p><strong>Percentual de Gordura:</strong> {$gordura}%</p>
  <p><strong>Atividade Física:</strong> {$atividade}</p>

  <h4>Resultado do Cálculo</h4>
  <p><strong>Anabolizante:</strong> {$anabolizante}</p>
  <p><strong>Calorias diárias:</strong> {$calorias} kcal</p>
  <p><strong>Status:</strong> {$status}</p>
  <p><strong>Dose semanal:</strong> {$dose_min}–{$dose_max} mg</p>
  <p><strong>Duração:</strong> {$semanas} semanas</p>
  <p><strong>Estimativa de ganho:</strong> 4–7 kg</p>
  <p><strong>Ampolas necessárias:</strong> {$ampolas}</p>
  <p><strong>Custo estimado:</strong> R$ {$custo},00</p>

  <h4>Aviso:</h4>
  <p style='color:red;'>Consulte sempre um profissional da saúde antes de iniciar qualquer protocolo hormonal.</p>
";

// Configurações do DOMPDF
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

// Gera o PDF
$dompdf->render();

// Envia o PDF para o navegador com o nome do usuário no nome do arquivo
$dompdf->stream("relatorio-ciclo-{$nome_arquivo}.pdf", ["Attachment" => false]);
exit;

?>
