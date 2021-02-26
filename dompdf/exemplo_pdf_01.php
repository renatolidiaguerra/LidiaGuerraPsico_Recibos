<?php

require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();



use Dompdf\Dompdf;


$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');


$dompdf->setPaper('A4', 'landscape');


$dompdf->render();


$dompdf->stream();

?>