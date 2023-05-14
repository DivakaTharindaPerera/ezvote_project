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

    public function getManagerImg($managerid){
        $this->db->query('SELECT Profile_image FROM system_manager WHERE ManagerID=:ManagerID');
        $this->db->bind(':ManagerID',$managerid);
        return $this->db->resultSet();

    }


    public function editPassword($email, $pwd){
        $this->db->query('UPDATE system_manager SET Password = :Password WHERE Email=:Email');

        $this->db->bind(':Email',$email);
        $this->db->bind(':Password',$pwd);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function profile($managerid){
        $this->db->query('SELECT * FROM system_manager WHERE ManagerID=:ManagerID');

        $this->db->bind(':ManagerID',$managerid);

        return $this->db->resultSet();
    }

    public function editProfile($name,$email,$pwd,$managerid){
        $this->db->query('UPDATE system_manager SET Name = :Name, Email =:Email, Password = :Password WHERE ManagerID=:ManagerID');
        
        $this->db->bind(':ManagerID',$managerid);
        $this->db->bind(':Password',$pwd);
        $this->db->bind(':Name',$name);
        $this->db->bind(':Email',$email);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function getUserEmail(){
        $this->db->query('SELECT Email from user');

        return $this->db->resultSet();

    }

    public function getVoterEmail(){
        $this->db->query('SELECT DISTINCT(user.Email) FROM user INNER JOIN voter ON voter.userId = user.UserId');

        return $this->db->resultSet();

    }

    public function getCandidateEmail(){
        $this->db->query('SELECT DISTINCT(user.Email) FROM user INNER JOIN candidate ON candidate.userId = user.UserId');

        return $this->db->resultSet();
    }

    public function getSupervisorEmail(){
        $this->db->query('SELECT DISTINCT(user.Email) FROM user INNER JOIN election ON election.Supervisor = user.UserId');

        return $this->db->resultSet();
    }



}