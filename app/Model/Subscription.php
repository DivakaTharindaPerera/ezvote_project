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

    public function deleteSubscriptionPlan($plan){
        $this->db->query('DELETE FROM subscription_plan WHERE PlanID = :PlanID');

        $this->db->bind(':PlanID', $plan);

        return $this->db->resultSet();
    }

}



?>