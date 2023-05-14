<?php 
require_once '../vendor/payment_config.php';

class Payment extends Controller
{
    private $PaymentsModel;
    
    public function __construct(){
        $this->PaymentsModel = $this->model('Payments');
    }

    public function index(){
        if(isset($_POST['amount'])){
            $_SESSION['donating_amount'] = $_POST['amount']*100;
        }
        // print_r($_SESSION['donating_amount']);die();
        
        $data =array();
        $this->view('paymentProcess', $data);
    }

    public function submit(){
        if(isset($_POST['stripeToken'])){
            // print_r($_POST['stripeToken']);die();
            +
            
            \Stripe\Stripe::setVerifySslCerts(false);
            try {
                $token=$_POST['stripeToken'];
        
                $data=\Stripe\Charge::create(array(
                    "amount"=> $_SESSION['donating_amount'],
                    "currency"=>"lkr",
                    "description"=>"Cash Donation",
                    "source"=>$token,
                ));

                $plan_id=$_GET['plan_id'];
                $plan = $this->PaymentsModel->getPlan($plan_id);
                $plan_name = $plan[0]->PlanName;
                $plan_Price = $plan[0]->Price;
                $plan_Discount = $plan[0]->Discount;

                $res = $this->PaymentsModel->selectPlan($plan_id);
                if (empty($res)) {
                    $user_count = 1;
                    $res2 = $this->PaymentsModel->insertSubscriptionPlan($plan_id,$plan_name,$plan_Price,$plan_Discount,$user_count);
                } else {
                    $user_count = $res[0]->userCount + 1;
                    $res2 = $this->PaymentsModel->updateCount($plan_id,$user_count);
                }
                header('Location: ./index?success=1&plan_id='.$plan_id);
            
            
            } catch(\Stripe\Exception\CardException $e) {
                // $_SESSION['PaymentError'] = $e->getError()->message;
                $plan_id=$_GET['plan_id'];
                header('Location: ./index?success=0&plan_id='.$plan_id);
                unset($_SESSION['donating_amount']);
        
        
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                // $_SESSION['PaymentError'] = $e->getError()->message;
                // print_r("An invalid request occurred.");
                $plan_id=$_GET['plan_id'];
                header('Location: ./index?success=0&plan_id='.$plan_id);
                unset($_SESSION['donating_amount']);
        
            } catch (Exception $e) {
                // print_r($e->getError()->message);
                // print_r("Another problem occurred, maybe unrelated to Stripe.");
                header('Location: ./index?success=0&plan_id='.$plan_id);
                unset($_SESSION['donating_amount']);      
            
            }
        }
    }

}

?>