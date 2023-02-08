<?php
session_start();
class Subscription_plan extends Controller
{
    public function __construct(){
        $this->SubscriptionModel = $this->model('Subscription');
    }

    // public function getSubscriptionPlan(){
    //     $this->model('Subscription')->getSubscriptionPlan();
    // }
    public function index()
    {


        if (!isset($_SESSION["UserId"])) {
            redirect('sys_manager/sysmanager_login');
        } else {
            $data[0] = $this->SubscriptionModel ->getSubscriptionPlan($_SESSION['UserId']);
            
            $this->view('sys_manager/subscription_plans',$data );
        }
        
    }

    public function create_process(){
        if(!$this->isLoggedIn()){
            $this->view('sys_manager/sysmanager_login');
        }else{
            $name = $_POST['name'];
            $description = $_POST['description'];
            $duration = $_POST['duration'];
            if(isset($_POST['price'])){
                $price = $_POST['price'];
            }else{
                $price = "FREE";
            }

            $time = $_POST['time'];
            $day = $_POST['day'];
            $month = $_POST['month'];
            $year = $_POST['year'];
            if((isset($_POST['box-1'])) or (isset($_POST['box-2'])) or (isset($_POST['box-3']))){
                $fullaccess = 0;
            }else{
                $fullaccess = 1;
            }
            if(isset($_POST['box-1'])){
                $cand_limit = $_POST['box-1'];
            }
            else{
                $cand_limit = NULL;
            }
            if(isset($_POST['box-2'])){
                $voter_limit = $_POST['box-2'];
            }
            else{
                $voter_limit = NULL;
            }
            if(isset($_POST['box-3'])){
                $election_limit = $_POST['box-3'];
            }
            else{
                $election_limit = 'NULL';
            }
            $cur_Date = date("Y-m-d");
            $manager_ID = $_SESSION['manager_ID'];

            $res = $this->SubscriptionModel->insertSubscriptionPlan($name,$description, $cur_Date, $day, $month, $year, $price, $fullaccess, $voter_limit, $cand_limit, $election_limit, $manager_ID);

            if($res){
                header("Location: /ezvote/system_manager/dashboard");
            }
            else{
                header("Location: /ezvote/subscription_plan/");
            }

        }

    }

    public function update_process($plan){
        if(!$this->isLoggedIn()){
            $this->view('sys_manager/sysmanager_login');
        }else{
            $name = $_POST['name'];
            $description = $_POST['description'];
            $duration = $_POST['duration'];
            if(isset($_POST['price'])){
                $price = $_POST['price'];
            }else{
                $price = "FREE";
            }

            $time = $_POST['time'];
            $day = $_POST['day'];
            $month = $_POST['month'];
            $year = $_POST['year'];
            if((isset($_POST['box-1'])) or (isset($_POST['box-2'])) or (isset($_POST['box-3']))){
                $fullaccess = 0;
            }else{
                $fullaccess = 1;
            }
            if(isset($_POST['box-1'])){
                $cand_limit = $_POST['box-1'];
            }
            else{
                $cand_limit = NULL;
            }
            if(isset($_POST['box-2'])){
                $voter_limit = $_POST['box-2'];
            }
            else{
                $voter_limit = NULL;
            }
            if(isset($_POST['box-3'])){
                $election_limit = $_POST['box-3'];
            }
            else{
                $election_limit = 'NULL';
            }
            $cur_Date = date("Y-m-d");
            $manager_ID = $_SESSION['manager_ID'];

            $res = $this->SubscriptionModel->updateSubscriptionPlan($plan,$name,$description, $cur_Date, $day, $month, $year, $price, $fullaccess, $voter_limit, $cand_limit, $election_limit, $manager_ID);



            if($res){
                header("Location: /ezvote/system_manager/dashboard");
            }
            else{
                header("Location: ../View/sys_manager/create_subscription.php");
            }

        }
    }

    public function sales_subscription(){
        if (!isset($_SESSION["UserId"])) {
            redirect('sysmanager/sysmanager_login');
        } else {
            $this->view('sys_manager/subscription_sales');
        }
    }

    public function edit_subscription(){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            $this->view('sys_manager/edit_subscription');
        }
    }

    public function create_subscription(){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            $this->view('sys_manager/create_subscription');
        }
    }
}
?>