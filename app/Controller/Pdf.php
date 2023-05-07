<?php

require dirname(approot) . '/vendor/autoload.php';

use Dompdf\Dompdf;

class Pdf extends Controller
{


    public function __construct(){
        
    }

    public function getPdf(){
        echo "generating";
        // $this->dompdf->loadHtml("hello world");
        // $this->dompdf->render();

        // $this->dompdf->stream('report.pdf');

        $this->pdfModel->getPdf();

    }

}
