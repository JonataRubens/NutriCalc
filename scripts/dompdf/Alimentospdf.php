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

// Caminho correto para o autoload do Composer
require_once __DIR__ . '/vendor/autoload.php';
define('BASE_PATH', realpath(__DIR__ . '/../../'));
require_once BASE_PATH . '/public/includes/db_connection.php';
require_once BASE_PATH . '/app/models/Perfil.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Pega dados da sessão
$usuario_nome = $_SESSION['usuario_nome'] ?? 'Usuário não identificado';

// Carrega perfil do banco
$perfilModel = new Perfil($conn);
$perfil = $perfilModel->buscarPorUsuario($_SESSION['usuario_id']);

if (!$perfil) {
    echo "<script>
            alert('Perfil não encontrado.');
            window.close();
          </script>";
    exit();
}

// Início do HTML
$html = "<h1>Relatório de Alimentos</h1>";
$html .= "<h3>Usuário: {$usuario_nome}</h3>";
$html .= "<p><strong>Sexo:</strong> {$perfil['sexo']}</p>";
$html .= "<p><strong>Idade:</strong> {$perfil['idade']} anos</p>";
$html .= "<p><strong>Altura:</strong> {$perfil['altura']} m</p>";
$html .= "<p><strong>Peso:</strong> {$perfil['peso']} kg</p>";

// Tabela de alimentos
$html .= '<h4>Lista de Alimentos Selecionados</h4>';
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

// Configurações do DOMPDF
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Nome limpo para o arquivo
$nome_arquivo = preg_replace('/[^a-zA-Z0-9_-]/', '_', $usuario_nome);

// Exibe o PDF no navegador
$dompdf->stream("relatorio-alimentos-{$nome_arquivo}.pdf", ["Attachment" => false]);

exit;
?>
