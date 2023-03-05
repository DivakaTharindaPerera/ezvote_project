<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    class Email{
        private $mail;
        public function __construct(){
            $this->mail = new PHPMailer(true);
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPAuth = true;
            $this->mail->Username = 'ezvoteservice@gmail.com';
            $this->mail->Password = 'avdvagetvbboufca';
            $this->mail->SMTPSecure = 'ssl';
            $this->mail->Port = 465;
            $this->mail->SMTPKeepAlive = true;
        }
        public function sendEmail($data){
            $this->mail->setFrom('ezvoteservice@gmail.com');
            $this->mail->addAddress($data['email']);
            $this->mail->isHTML(true);
            $this->mail->Subject = $data['subject'];
            $this->mail->Body = $data['body'];
            
            try {
                $this->mail->send();
                return true;
            } catch (Exception $e) {
                echo "Something went wrong :".$e->getMessage();
                return false;
            }
        }
    }     
?>