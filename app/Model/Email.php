<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    class Email{
        public function __construct(){
            
        }
        public function sendEmail($data){
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ezvoteservice@gmail.com';
            $mail->Password = 'avdvagetvbboufca';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('ezvoteservice@gmail.com');
            $mail->addAddress($data['email']);
            $mail->isHTML(true);
            $mail->Subject = $data['subject'];
            $mail->Body = $data['body'];
            
            try {
                $mail->send();
                return true;
            } catch (Exception $e) {
                echo "Something went wrong :".$e->getMessage();
                return false;
            }
        }
    }

    
        

        
?>