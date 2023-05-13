<?php 

Class Payments{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function selectPlan($plan){

            $this->db->query('SELECT * FROM sale_subscription WHERE PlanID = :PlanID');
            $this->db->bind(':PlanID',$plan);

            $res = $this->db->resultSet();
            return $res;
    }

    public function getPlan($plan){
        $this->db->query('SELECT * FROM subscription_plan WHERE PlanID = :PlanID');
        $this->db->bind(':PlanID',$plan);

        $res = $this->db->resultSet();
        return $res;
    }

    public function insertSubscriptionPlan($plan_id,$plan_name,$plan_Price,$plan_Discount,$user_count)
    {
        $this->db->query('INSERT INTO sale_subscription(PlanName, Price, userCount, Discount, PlanID) VALUES (:PlanName, :Price, :userCount, :Discount, :PlanID)');

        $this->db->bind(':PlanName', $plan_name);
        $this->db->bind(':Price', $plan_Price);
        $this->db->bind(':userCount', $user_count);
        $this->db->bind(':Discount', $plan_Discount);
        $this->db->bind(':PlanID',$plan_id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function updateCount($plan,$user_count){
        $this->db->query('UPDATE sale_subscription SET userCount = :user_count WHERE PlanID = :PlanID');

                $this->db->bind(':planID',$plan);
                $this->db->bind(':user_count',$user_count);

                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
    }

    public function selectSaleDetails($plan,$name,$price,$discount){
        if(isset($_GET['plan_id'])){
            $plan = $_GET['plan_id'];
            $this->db->query('SELECT * FROM sale_subscription WHERE PlanID = :PlanID');
            $this->db->bind(':PlanID',$plan);

            $res = $this->db->resultSet();
            if(sizeof($res) == 0){
                
                $this->db->query('INSERT INTO sale_subscription(PlanName, Price, userCount, Discount) VALUES (:PlanName, :Price, :userCount, :Discount)');

                $this->db->bind(':PlanName', $name);
                $this->db->bind(':Price', $price);
                $this->db->bind(':userCount', 1);
                $this->db->bind(':Discount', $discount);

                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }

            } else {
                $this->db->query('UPDATE sale_subscription SET userCount = userCount + 1 WHERE PlanID = :PlanID');

                $this->db->bind(':planID',$plan);

                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}


?>