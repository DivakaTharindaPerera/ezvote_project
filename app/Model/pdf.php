<?php
require 'dompdf_2-0-3/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class pdf{

    public function __construct(){
        $options = new Options;
        $options->setChroot(__DIR__);
        $this->dompdf = new Dompdf($options);
    }

    public function testing(){
        echo "hello";
        // $this->dompdf->loadHtml("hello world");
        $this->dompdf->loadHtmlFile("contact.php");
        $this->dompdf->render();
        $this->dompdf->stream("report.pdf", ["Attachment" => 0]);
    }

    public function getPdf($data){
        $this->dompdf->loadHtml($data['html']);
        $this->dompdf->render();
        $this->dompdf->stream($data['filename'], ["Attachment" => $data['attachment']]);
    }
}
