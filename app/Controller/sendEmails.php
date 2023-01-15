<?php

class sendEmails extends Controller{
    private $mailModel;

    public function __construct(){
        $this->mailModel = $this->model('Email');
    }

    public function sendEmail(){
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $data = [
                'email' => trim($_POST['email']),
                'subject' => trim($_POST['subject']),
                'body' => trim($_POST['body'])
            ];
            $this->mailModel->sendEmail($data);
        } 
    }

    public function showView(){
        $this->view('sendEmail');
    }
}