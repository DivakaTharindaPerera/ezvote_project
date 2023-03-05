<?php

class sendEmails extends Controller{
    private $mailModel;

    public function __construct(){
        $this->mailModel = $this->model('Email');
    }

    public function sendEmailNow(){
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $data = [
                'email' => trim($_POST['email']),
                'subject' => trim($_POST['subject']),
                'body' => trim($_POST['body'])
            ];
            
            for ($i=0; $i < 10 ; $i++) { 
                if($this->mailModel->sendEmail($data)){
                    echo "Email sent $i+1";
                }else{
                    echo "Email not sent $i+1";
                }
            }
        } 
    }
}