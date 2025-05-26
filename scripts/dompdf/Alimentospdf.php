<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /');
    exit();
}

// Verifica se a lista foi enviada
if (!isset($_POST['lista_alimentos'])) {
    echo "Lista de alimentos não recebida.";
    exit();
}

$lista = json_decode($_POST['lista_alimentos'], true);

if (!$lista) {
    echo "Erro ao processar a lista.";
    exit();
}

require_once __DIR__ . '/vendor/autoload.php'; // Se estiver usando dompdf ou mPDF

use Dompdf\Dompdf;

// Cria o conteúdo HTML
$html = '<h1>Relatório de Alimentos</h1>';
$html .= '<table border="1" cellspacing="0" cellpadding="5">';
$html .= '<thead>
            <tr>
              <th>Descrição</th>
              <th>Categoria</th>
              <th>Energia</th>
              <th>Proteína</th>
              <th>Lipídios</th>
              <th>Carboidratos</th>
            </tr>
          </thead><tbody>';

foreach ($lista as $alimento) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($alimento['descricao']) . '</td>';
    $html .= '<td>' . htmlspecialchars($alimento['categoria']) . '</td>';
    $html .= '<td>' . htmlspecialchars($alimento['energia']) . '</td>';
    $html .= '<td>' . htmlspecialchars($alimento['proteina']) . '</td>';
    $html .= '<td>' . htmlspecialchars($alimento['lipideos']) . '</td>';
    $html .= '<td>' . htmlspecialchars($alimento['carboidratos']) . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';

// Gera o PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Baixa o PDF
$dompdf->stream('relatorio_alimentos.pdf', ['Attachment' => 0]); // 0 = abre no navegador
?>
