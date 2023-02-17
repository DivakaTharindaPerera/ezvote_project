<?php
session_start();
class Subscription_plan extends Controller
{
    private $SubscriptionModel;

    public function __construct(){
        $this->SubscriptionModel = $this->model('Subscription');
    }

    public function index()
    {

        if (!isset($_SESSION["UserId"])) {
            redirect('Sys_manager/Sysmanager_login');
        } else {
            $data[0] = $this->SubscriptionModel ->getSubscriptionPlan($_SESSION['UserId']);
            
            $this->view('Sys_manager/subscription_plans',$data );
        }
        
    }

    public function create_process(){
        if(!$this->isLoggedIn()){
            $this->view('Sys_manager/Sysmanager_login');
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
                header("Location: /ezvote/System_manager/dashboard");
            }
            else{
                header("Location: /ezvote/Subscription_plan/create_process");

            }

        }

    }

    public function update_process($plan){
        if(!$this->isLoggedIn()){
            $this->view('Sys_manager/Sysmanager_login');
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
                header("Location: /ezvote/System_manager/dashboard");
            }
            else{

                header("Location: /ezvote/System_manager/dashboard");

            }

        }
    }

    public function sales_subscription(){
        if (!isset($_SESSION["UserId"])) {
            redirect('Sysmanager/Sysmanager_login');
        } else {
            $this->view('Sys_manager/subscription_sales');
        }
    }

    public function edit_subscription($plan){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            $data = $this->SubscriptionModel ->viewSubscriptionPlan($plan);
            
            $this->view('Sys_manager/edit_subscription',$data );
            
        }
    }

    public function delete_subscription($plan){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            $data = $this->SubscriptionModel ->deleteSubscriptionPlan($plan);
            redirect('Subscription_plan/index');
            
        }
    }

    public function create_subscription(){
        if (!isset($_SESSION["UserId"])) {
            redirect('System_manager/login');
        } else {
            $this->view('Sys_manager/create_subscription');
        }
    }
}
?>