<?php

class Manager{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }



    public function verifyLogin($email,$pwd){
        $this->db->query('SELECT * FROM system_manager WHERE Email=:email');
        $this->db->bind(':email',$email);

        $row = $this->db->single();
        $hashed = ($row-> Password);
        $_SESSION['manager_ID'] = $row->ManagerID;
        // print_r($_SESSION['manager_ID']);die();
        $_SESSION['fname'] = $row->Name;
        return $hashed;

    }

    public function getSubscriptionPlan($managerid){
        $this->db->query('SELECT * FROM subscription_plan WHERE ManagerID=:ManagerID');
        $this->db->bind(':ManagerID',$managerid);
        return $this->db->resultSet();

    }

    public function getManagerName($managerid){
        $this->db->query('SELECT name FROM system_manager WHERE ManagerID=:ManagerID');
        $this->db->bind(':ManagerID',$managerid);
        return $this->db->resultSet();

    }

    public function updatePassword($email, $pwd){
        $this->db->query('UPDATE system_manager SET Password = :Password WHERE Email=:Email');

        $this->db->bind(':Email',$email);
        $this->db->bind(':Password',$pwd);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


}