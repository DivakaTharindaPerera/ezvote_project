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
            $password = $_POST['password'];
            
            $hashed = $this->ManagerModel->verifyLogin($email, $password);

            if (password_verify($password, $hashed)) {
                $_SESSION['UserId'] = $_SESSION['manager_ID'];
                $man_name = $this->ManagerModel->getManagerName($_SESSION['manager_ID']);
                $_SESSION['name'] = $man_name[0]->name;
                $sub_plans = $this->ManagerModel->getSubscriptionPlan($_SESSION['manager_ID']);
                $data = [$sub_plans];
                $this->view('Sys_manager/sysmanager_dashboard', $data);
            } else {
                $data = [
                    'error' => "invalid email or password",
                    'email' => $email
                ]; 
                $this->view('Sys_manager/Sysmanager_login',$data);
                
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
                $mail = $_SESSION['email'];
                $pwd = $this->ManagerModel->editPassword($mail,$_POST['pwd']);
                
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
                    $this->view('Sys_manager/sysmanager_dashboard');
                } catch (Exception $e) {
                    echo "Message could not be sent. Please try again later.";
                }
                
            }
            $this->view('Sys_manager/sysmanager_announcements');
        }
    }

    public function managerProfile(){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            $manager_id = $_SESSION['manager_ID'];
            $data = $this->ManagerModel->profile($manager_id);

            $this->view('Sys_manager/manager_profile',$data);
        }
    }

    public function editManagerDetails($manager_id){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            $manager_id = $_SESSION['manager_ID'];
            $data = $this->ManagerModel->profile($manager_id);
            $this->view('Sys_manager/manager_update_profile',$data);
        }
    }

    public function updateProfile(){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $current_pwd = $_POST['current_password'];
                $new_pwd = $_POST['new_password'];
                $confirm_pwd = $_POST['confirm_password'];
                $current_pwdError = '';
                $new_pwdError = '';
                $confirm_pwdError = '';
                
                if(!empty($name) && !empty($email) && empty($current_pwd) && !empty($new_pwd) && !empty($confirm_pwd)){
                    $current_pwdError = "Please enter current password";
                }
                if(!empty($name) && !empty($email) && !empty($current_pwd) && !empty($new_pwd) && empty($confirm_pwd)){
                    $confirm_pwdError = "Please enter confirm password";
                }
                $managerid = $_SESSION['manager_ID'];
                $res = $this->ManagerModel->profile($managerid);
                if (empty($current_pwdError)) {
                    if (empty($current_pwd)) {
                        $managerid = $_SESSION['manager_ID'];
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $current_pwd = $res[0]->Password;
                        $new_pwd = $res[0]->Password;
                        $confirm_pwd = $res[0]->Password;
                        $current_passwordError = '';
                        $new_passwordError = '';
                        $confirm_passwordError = '';
                        
                        $this->ManagerModel->editProfile($name,$email,$new_pwd,$managerid);
                        redirect('System_manager/dashboard');

                    } else {
                        if ((password_verify($current_pwd, $res[0]->Password))) {
                            if ($new_pwd === $confirm_pwd) {
                                $new_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);
            
                                $this->ManagerModel->editProfile($name,$email,$new_pwd,$managerid);
                                redirect('System_manager/dashboard');
                            } else {
                                $confirm_pwdError = "Password does not match";
                            }
                        } else {
                            $current_pwdError = "Password does not match";
                        }
                    }
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    
                } else {
                    $current_pwdError = "Please enter current password";
                }
                $this->view('Sys_manager/manager_update_profile',$managerid);
            }
            $this->view('Sys_manager/manager_update_profile');
        }
    }



    public function updateProfileProcess($managerid){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            $man_profile = $this->ManagerModel->getManagerImg($_SESSION['manager_ID']);
            $_SESSION['profile_img'] = $man_profile[0]->name;
            $name = $_POST['name'];
            $email = $_POST['email'];
            $managerid = $_SESSION['manager_ID'];

            $res = $this->ManagerModel->editProfile($name,$email,$managerid);
            if($res){
                header('Location: /ezvote/System_manager/dashboard');
            } else {
                header('Location: /ezvote/System_manager/updateProfileProcess');
            }
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