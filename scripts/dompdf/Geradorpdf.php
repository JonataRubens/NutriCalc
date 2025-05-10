<?php
use Dompdf\Dompdf;

require_once './autoload.inc.php';

$dompdf = new Dompdf();

$dompdf->load_html("Ainda to estilizando a ");

$dompdf->set_option('defaultFont','sans');

$dompdf->set_paper('A4','potrait');//se quiser que seja em retrato usa o "landscape"

$dompdf->render();

$dompdf->stream();
?>