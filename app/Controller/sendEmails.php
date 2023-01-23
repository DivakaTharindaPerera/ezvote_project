<?php

class sendEmails extends Controller{
    private $mailModel;

    public function __construct(){
        $this->mailModel = $this->model('Email');
    }

    public function sendEmailNow(){
        echo "landed correctly";
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $data = [
                'email' => trim($_POST['email']),
                'subject' => trim($_POST['subject']),
                'body' => trim($_POST['body'])
            ];
            if($this->mailModel->sendEmail($data)){
                echo "Email sent";
            }else{
                echo "Email not sent";
            }
        } 
    }
}