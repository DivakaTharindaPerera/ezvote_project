<?php
session_start();
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
        // print_r($_SESSION['manager_ID']);
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


}