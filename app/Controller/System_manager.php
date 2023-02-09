<?php

class System_manager extends Controller
{
    private $ManagerModel;
    
    public function __construct(){
        $this->ManagerModel = $this->model('Manager');
    }


    public function login(){
        
        if($this->isLoggedIn()){

            redirect('./dashboard');
        }else{
            $data =[];
            $this->view('Sys_manager/Sysmanager_login', $data);
        }
    }

    public function dashboard(){
        if($this->isLoggedIn()){
            // print_r('login');
            $man_name = $this->ManagerModel->getManagerName($_SESSION['manager_ID']);
            $_SESSION['name'] = $man_name[0]->name;
            
            $sub_plans = $this->ManagerModel->getSubscriptionPlan($_SESSION['manager_ID']);
            $data = [$sub_plans];
            $this->view('Sys_manager/sysmanager_dashboard', $data);

        } else {
            // print_r('no-login');
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];
            

            $hashed = $this->ManagerModel->verifyLogin($email, $pwd);

            if (password_verify($pwd, $hashed)) {
                $sub_plans = $this->ManagerModel->getSubscriptionPlan($_SESSION['manager_ID']);
                $_SESSION['UserId'] = $_SESSION['manager_ID'];
                $man_name = $this->ManagerModel->getManagerName($_SESSION['manager_ID']);
                $_SESSION['name'] = $man_name[0]->name;
                $data = [$sub_plans];
                $this->view('Sys_manager/sysmanager_dashboard', $data);
            } else {
                header("Location: ./login");
            }
        }

    }

    public function announcements(){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            $this->view('Sys_manager/sysmanager_announcements');
            // redirect('');

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