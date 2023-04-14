<?php

// use PHPmailer\PHPMailer\PHPMailer;
// use PHPmailer\PHPmailer\SMTP;

// require '../Model/PHPMailer/src/Exception.php';
// require '../Model/PHPMailer/src/PHPMailer.php';
// require '../Model/PHPMailer/src/SMTP.php';


class Users extends Controller{
    private $userModel;
    private $mail;
    private $userEncrypt;

    public function __construct(){
        $this->userModel = $this->model('User');
        $this->mail = $this->model('Email');
        $this->userEncrypt = $this->model('userEncrypt');
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data =[
                'fname' => trim($_POST["fname"]),
                'lname' => trim($_POST["lname"]),
                'email' => trim($_POST["email"]),
                'password' => trim($_POST["password"]),
                'vCode' => substr(number_format(time() * rand() , 0, '', ''), 0, 6),
                'emailError' => ''
            ];

            //checking for the email
            if($this->userModel->findUserByEmail($data['email'])){
                $data['emailError'] = "Email is already taken";
                $this->view('register',$data);
            }else{
                //hashing password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                $subject = "Email Verification Code";
                $msg = "Your verification code for the ezVote.lk is: <b> " . $data['vCode']."</b> <br> You can verify the email after the registration and after the login before proceeding to the account.";
                
                $emailData = [
                    'email' => $data['email'],
                    'subject' => "Verify your email",
                    'body' => $msg
                ];

                try {
                    $this->mail->sendEmail($emailData);
                } catch (Exception $e) {
                    echo "Message could not be sent. Please try again later.";
                }

                if($this->userModel->registerUser($data)){
                    $this->view('verifyEmail',$data);
                }else{
                    die("Something went wrong");
                }
            }

        }
    }

    public function verifyEmail(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $email = trim($_POST["email"]);
            $code = trim($_POST["verification_code"]);
            
            if($this->userModel->verificationCode($email,$code)){
                $user = $this->userModel->getUserByEmail($email);
                if($this->userModel->userIdAutoFill($user->UserId,$email)){
                    redirect('View/login');
                }else{
                    echo "Something went wrong";
                }
                
            }else{
                $data =[
                    'email' => $_POST["email"],
                    'vCode' => $_POST["code"],
                    'verifyError' => "invalid verification code. try again"
                ];
                $this->view('verifyEmail',$data);
            }
        }
    }

    
}