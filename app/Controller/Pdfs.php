<?php

class Pdfs extends Controller
{
    private $pdfModel;

    public function __construct(){
       $this->pdfModel = $this->model('pdf');
       $this->electionModel = $this->model('election');
    }

    public function testings(){
        echo "generating";
        // $this->dompdf->loadHtml("hello world");
        // $this->dompdf->render();

        // $this->dompdf->stream('report.pdf');
        $this->pdfModel->testing();
    }

    public function getPdf($eid){
        
    }

}
