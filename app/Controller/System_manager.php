<?php



class System_manager extends Controller
{
    private $ManagerModel;
    private $mail;
    
    public function __construct(){
        $this->ManagerModel = $this->model('Manager');
        $this->mail = $this->model('Email');
    }


    public function login(){
        
        if($this->isLoggedIn()){

            redirect('./dashboard');
        }else{
            $data =[];
            $this->view('Sys_manager/Sysmanager_login', $data);
        }
    }

    public function forgot(){
        
        if($this->isLoggedIn()){

            redirect('./reset');
        }else{
            $data =[];
            $this->view('forgot_password', $data);
        }
    }

    public function reset(){
        
        if($this->isLoggedIn()){

            redirect('./login');
        }else{
            $data =[];
            $this->view('reset_password', $data);
        }
    }

    public function dashboard(){
        if($this->isLoggedIn()){
            $man_name = $this->ManagerModel->getManagerName($_SESSION['manager_ID']);
            $_SESSION['name'] = $man_name[0]->name;
            
            $sub_plans = $this->ManagerModel->getSubscriptionPlan($_SESSION['manager_ID']);
            $data = [$sub_plans];
            $this->view('Sys_manager/sysmanager_dashboard', $data);

        } else {
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];
            
            $hashed = $this->ManagerModel->verifyLogin($email, $pwd);

            if (password_verify($pwd, $hashed)) {
                $_SESSION['UserId'] = $_SESSION['manager_ID'];
                $man_name = $this->ManagerModel->getManagerName($_SESSION['manager_ID']);
                $_SESSION['name'] = $man_name[0]->name;
                $sub_plans = $this->ManagerModel->getSubscriptionPlan($_SESSION['manager_ID']);
                $data = [$sub_plans];
                $this->view('Sys_manager/sysmanager_dashboard', $data);
            } else {
                header("Location: ./login");
            }
        }

    }

    public function sendOTP()
    {
        $data['vCode'] =  substr(number_format(time() * rand() , 0, '', ''), 0, 6);
        $_SESSION['vCode'] = $data['vCode'];
        $data['subject'] = "Reset Your Account";
        $data['body'] = "Your verification code for the ezVote.lk is: <b> " . $data['vCode']."</b> <br> You can verify the email.";
        $data['email'] = $_POST['email'];

        $res =  $this->mail->sendEmail($data);
        if ($res) {
            header("Location: ./reset");
        } else {
            header("Location: ./forgot");
        }
        
    }

    public function update()
    {
        if ($_POST['v-code'] == $_SESSION['vCode']) {
            unset($_SESSION['vCode']);
            if ($_POST['pwd'] = $_POST['confirm-pwd']) {
                $pwd = $this->ManagerModel->updatePassword($_POST['pwd']);
                $mail = $_SESSION['email'];
            }
            else {
                header("Location: ./reset");
            }
        }
        else {
            header("Location: ./forgot");
        }
    }


    public function announcements(){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            // print_r($_POST);die();
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data['subject'] = $_POST['head'];
                $data['body'] = $_POST['body'];
                $mails = array();
                $mail_count =0;

                $radio = isset($_POST['user']) ? $_POST['user'] : null;
                
                if($radio == 'alluser'){
                    $res = $this->ManagerModel->getUserEmail();
                    $mails = $res;

                } else if($radio == 'specificuser') {
                    if(isset($_POST['Supervisors'])){
                        $res = $this->ManagerModel->getSupervisorEmail();
                        $mails = array_merge($mails,$res);
                    } 
                    if(isset($_POST['Voters'])){
                        $res = $this->ManagerModel->getVoterEmail();
                        $mails = array_merge($mails,$res);
                    }
                    if(isset($_POST['Candidates'])){
                        $res = $this->ManagerModel->getCandidateEmail();
                        $mails = array_merge($mails,$res);
                    }
                }
                $mail_count = count($mails);
                // print_r($mail_count);die();
                // print_r($mails[0]->Email);die();
                try {
                    for ($i=0; $i < $mail_count; $i++) { 
                        $data['email'] = $mails[$i]->Email;
                        $this->mail->sendEmail($data);
    
                    }
                    $this->view('Sys_manager/sysmanager_announcements');
                } catch (Exception $e) {
                    echo "Message could not be sent. Please try again later.";
                }
                
            }
            $this->view('Sys_manager/sysmanager_announcements');
        }
    }

    public function logout(){
        unset($_SESSION['UserId']);
        session_start();
        session_destroy();
        redirect('System_manager/login');
    }
}

?>