<?Php

require '../vendor/autoload.php';
//require_once 'vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

    $html2pdf = new Html2Pdf();

    ob_start();
    require_once 'reportepdf.php';
    $html = ob_get_clean();

    $html2pdf->writeHTML($html);

    $html2pdf->output('ReporteMSI.pdf');

?>


