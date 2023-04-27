<?php

class Subscription{

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getSubscriptionPlan($managerid){
        $this->db->query('SELECT * FROM subscription_plan WHERE ManagerID=:ManagerID');
        $this->db->bind(':ManagerID',$managerid);
        return $this->db->resultSet();

    }

    public function insertSubscriptionPlan($name,$description, $cur_Date, $day, $month, $year, $price, $fullaccess, $voter_limit, $cand_limit, $election_limit, $manager_ID){

        $this->db->query('INSERT INTO subscription_plan (PlanName, Description, Date, DurationDate, DurationMonth, DurationYear, Price, FullAccess, VotersLimit, CandidateLimit, ElectionLimit, ManagerID) VALUES (:PlanName, :Description, :Date, :DurationDate, :DurationMonth, :DurationYear, :Price, :FullAccess, :VotersLimit, :CandidateLimit, :ElectionLimit, :ManagerID)');
        $this->db->bind(':PlanName', $name);
        $this->db->bind(':Description', $description);
        $this->db->bind(':Date', $cur_Date);
        $this->db->bind(':DurationDate', $day);
        $this->db->bind(':DurationMonth', $month);
        $this->db->bind(':DurationYear', $year);
        $this->db->bind(':Price', $price);
        $this->db->bind(':FullAccess', $fullaccess);
        $this->db->bind(':VotersLimit', $voter_limit);
        $this->db->bind(':CandidateLimit', $cand_limit);
        $this->db->bind(':ElectionLimit', $election_limit);
        $this->db->bind(':ManagerID', $manager_ID);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function viewSubscriptionPlan($plan){
        $this->db->query('SELECT * FROM subscription_plan WHERE PlanID = :PlanID');

        $this->db->bind(':PlanID', $plan);

        return $this->db->resultSet();
        
            
    }

    public function updateSubscriptionPlan($plan,$name,$description, $cur_Date, $day, $month, $year, $price, $fullaccess, $voter_limit, $cand_limit, $election_limit, $manager_ID){
        $this->db->query('UPDATE subscription_plan SET PlanName=:PlanName,Description= :Description,Date= :Date,DurationDate= :DurationDate,DurationMonth= :DurationMonth,DurationYear= :DurationYear,Price= :Price,FullAccess= :FullAccess,VotersLimit= :VotersLimit,CandidateLimit= :CandidateLimit,ElectionLimit= :ElectionLimit,ManagerID= :ManagerID WHERE PlanID = :PlanID');

        $this->db->bind(':PlanName', $name);
        $this->db->bind(':Description', $description);
        $this->db->bind(':Date', $cur_Date);
        $this->db->bind(':DurationDate', $day);
        $this->db->bind(':DurationMonth', $month);
        $this->db->bind(':DurationYear', $year);
        $this->db->bind(':Price', $price);
        $this->db->bind(':FullAccess', $fullaccess);
        $this->db->bind(':VotersLimit', $voter_limit);
        $this->db->bind(':CandidateLimit', $cand_limit);
        $this->db->bind(':ElectionLimit', $election_limit);
        $this->db->bind(':ManagerID', $manager_ID);
        $this->db->bind(':PlanID', $plan);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function editSubscriptionDiscount($plan,$discount){
        $this->db->query('UPDATE sale_subscription SET Discount=:Discount WHERE planID = :planID');

        $this->db->bind(':Discount',$discount);
        $this->db->bind(':planID', $plan);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function saleSubscriptionPlan(){
        $this->db->query('SELECT * FROM sale_subscription');

        return $this->db->resultSet();
    }

    public function deleteSubscriptionPlan($plan){
        $this->db->query('DELETE FROM subscription_plan WHERE PlanID = :PlanID');

        $this->db->bind(':PlanID', $plan);

        return $this->db->resultSet();
    }

    public function addChanges($plan, $cur_Date, $cur_Time, $description){
        // print_r($description);die();
        $this->db->query('INSERT INTO plan_changes (PlanID, Date, Time, Description) VALUES (:PlanID, :Date, :Time, :Description)');

        $this->db->bind(':PlanID', $plan);
        $this->db->bind(':Date', $cur_Date);
        $this->db->bind(':Time', $cur_Time);
        $this->db->bind(':Description', $description);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function viewChanges(){
        $this->db->query('SELECT * FROM plan_changes');

        return $this->db->resultSet();
    }

}



?>