<?php 

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Customer;


require_once('stripe-php/init.php');

class Payment extends Controller{

    private $PaymentsModel;

    public function __construct(){
        $this->PaymentsModel= $this->model('Payments');
    }

    public function paymentInit(){
        Stripe::setApiKey(STRIPE_API_KEY);

        $jsonstr = file_get_contents('php://input');
        $jsonObj = json_decode($jsonstr);
        $planPrice = 500;
        $plan = $this->PaymentsModel->planID;
        $name = $this->PaymentsModel->planName;

        if($jsonObj->request_type == 'create_payment_intent'){
            $planPriceCents = round($planPrice*100);

            header('Content-Type: application/json');

            try {
                $paymentIntent = PaymentIntent::create([
                    'amount' => $planPriceCents,
                    'currency' => "lkr",
                    'description' => "Demo Plan",
                    'payment_method_types' => [
                        'card'
                    ]
                ]);

                $output = [
                    'id' => $paymentIntent->id,
                    'clientSecret' => $paymentIntent->client_secret
                ];

                echo json_encode($output);
            } catch (Error $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        } elseif($jsonObj->request_type == 'create_customer'){
            $payment_intent_id = !empty($jsonObj->payment_intent_id)?$jsonObj->payment_intent_id:'';
            $name = !empty($jsonObj->name)?$jsonObj->name:''; 
            $email = !empty($jsonObj->email)?$jsonObj->email:'';

            try {
                $customer = Customer::create(array(
                    'name' => $name,
                    'email' => $email 
                ));
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }

            if(empty($api_error) && $customer){
                try {
                    $paymentIntent = PaymentIntent::update($payment_intent_id, [
                        'customer' => $customer->id

                    ]);
                } catch (Exception $e) {
                    //throw $th;
                }

                $output = [
                    'id' => $payment_intent_id,
                    'customer_id' => $customer->id
                ];
                echo json_encode($output);
            } else {
                http_response_code(500);
                echo json_encode(['error' => $api_error]);
            }
        } elseif($jsonObj->request_type == 'Payment_insert'){
            $payment_intent = !empty($jsonObj->payment_intent)?$jsonObj->payment_intent:'';
            $customer_id = !empty($jsonObj->customer_id)?$jsonObj->customer_id:'';

            try {   
                $customer = Customer::retrieve($customer_id);  
            }catch(Exception $e) {   
                $api_error = $e->getMessage();   
            }

            if(!empty($payment_intent) && $payment_intent->status == 'succeeded'){ 
                // Transaction details  
                $transaction_id = $payment_intent->id; 
                $paid_amount = $payment_intent->amount; 
                $paid_amount = ($paid_amount/100); 
                $paid_currency = $payment_intent->currency; 
                $payment_status = $payment_intent->status; 
                
                $customer_name = $customer_email = ''; 
                if(!empty($customer)){ 
                    $customer_name = !empty($customer->name)?$customer->name:''; 
                    $customer_email = !empty($customer->email)?$customer->email:''; 
                }

                $this->PaymentsModel->checkTransaction($transaction_id);

                $payment_id = 0;
                if(!empty($row_id)){
                    $payment_id = $row_id;
                } else {
                    $this->PaymentsModel->addTransaction($payment_id,$customer->name,$customer->email,$name,$planPrice,$transaction_id,$payment_status,$plan,$customer);
                }

        }
        $output = [
            'payment_txn_id' => base64_encode($transaction_id)
        ];
        echo json_encode($output);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Transaction has been failed!']);
    }
    }

    public function paymentStatus(){
        $payment_ref_id = $statusMsg = '';
        $status = 'error';
        $name = $this->PaymentsModel->planName;
        $txn_id = $this->PaymentsModel->transactionID;
        $paid_amount = $this->PaymentsModel->planPrice;
        $paid_amount_currency = 'lkr';
        $customer_name = $this->PaymentsModel->userName;
        $customer_email = $this->PaymentsModel->userEmail;
        $planPrice = $this->PaymentsModel->planPrice;
        $currency = 'lkr';


        if(!empty($_GET['pid'])){
            $payment_txn_id = base64_decode($_GET['pid']);

            $sql = $this->PaymentsModel->getTransaction();

            if($sql->num_rows > 0){
            $status = 'success';
            $statusMsg = 'Your payment has been successful';
            } else {
                $statusMsg = "Transaction has been failed!"; 
            }
        } else {
            header("Location: index.php");
            exit;
        }
    ?>
    
    <?php 
    $payment_status = "paid" OR "unpaid";
    
    if(!empty($payment_ref_id)){ ?>
        <h1 class="<?php echo $status; ?>"><?php echo $statusMsg; ?></h1>
        
        <h4>Payment Information</h4>
        <p><b>Reference Number:</b> <?php echo $payment_ref_id; ?></p>
        <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>
        <p><b>Paid Amount:</b> <?php echo $paid_amount.' '.$paid_amount_currency; ?></p>
        <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
        
        <h4>Customer Information</h4>
        <p><b>Name:</b> <?php echo $customer_name; ?></p>
        <p><b>Email:</b> <?php echo $customer_email; ?></p>
        
        <h4>Product Information</h4>
        <p><b>Name:</b> <?php echo $name; ?></p>
        <p><b>Price:</b> <?php echo $planPrice.' '.$currency; ?></p>
    <?php }else{ ?>
        <h1 class="error">Your Payment been failed!</h1>
        <p class="error"><?php echo $statusMsg; ?></p>
    <?php } ?>
    <?php
}
}?>
