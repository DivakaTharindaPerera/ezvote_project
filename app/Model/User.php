<?php

class User{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getUsers(){
        $this->db->query("SELECT * FROM User;");

        return $this->db->resultSet();
    }

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM User WHERE Email=:email');
        $this->db->bind(':email',$email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            //user exists
            return true;
        }else{
            //user not exists
            return false;
        }
    }

    public function getUserById($id){
        $this->db->query("SELECT * FROM User WHERE UserId = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }

    public function getUserByEmail($email){
        $this->db->query("SELECT * FROM User WHERE  Email= :id");
        $this->db->bind(':id', $email);
        $row = $this->db->single();

        return $row;
    }

    //register users
    public function registerUser($data){
        $this->db->query('INSERT INTO User (Fname, Lname, Email, Password, verification_code) VALUES (:fname, :lname, :email, :password, :vcode)');
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':vcode', $data['vCode']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function verificationCode($email,$verificationCode){
        $this->db->query('UPDATE User SET email_verified_at = NOW() WHERE Email =:email AND verification_code = :code');
        $this->db->bind(':email',$email);
        $this->db->bind(':code',$verificationCode);

        $row = $this->db->execute();

        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }


    public function pricingPlan(){
        $this->db->query('SELECT  DISTINCT(PlanName), PlanID, Price FROM subscription_plan WHERE plan_status = :status');
        $this->db->bind(':status',1);

        return $this->db->resultSet();
    }

    public function enabledplanbyID($plan){
        $this->db->query('SELECT Price FROM subscription_plan WHERE plan_status = :status AND PlanID = :PlanID');
        $this->db->bind(':status',1);
        $this->db->bind(':PlanID',$plan);

        return $this->db->resultSet();
    }

    public function userIdAutoFill($id,$email){
        //updating voter table
        $this->db->query("UPDATE Voter SET userId = :id WHERE Email = :email");
        $this->db->bind(':id', $id);
        $this->db->bind(':email', $email);
        
        try {
            $this->db->execute();
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }

        //updating candidate table
        $this->db->query("UPDATE Candidate SET userId = :id WHERE candidateEmail = :email");
        $this->db->bind(':id', $id);
        $this->db->bind(':email', $email);

        try {
            $this->db->execute();
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }

        //updating party table
        $this->db->query("UPDATE ElectionParty SET userId = :id WHERE supEmail = :email");
        $this->db->bind(':id', $id);
        $this->db->bind(':email', $email);

        try {
            $this->db->execute();
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }

        return true;
    }

    public function updateProfile($data)
    {
        $this->db->query('UPDATE user SET Fname = :fname, Lname = :lname, Email = :email,Password= :password WHERE UserId = :id');
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['new_password']);
        $this->db->bind(':id', $data['id']);
        try{
            $this->db->execute();
        }
        catch (Exception $e){
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
        return true;
    }

    public function uploadProfileImage($data)
    {
        $path = approot."/../public/upload/profile_pictures/";

        $fileName="profile_pic_".time()."_".$data['id'].".".pathinfo($data['profile_pic']['name'],PATHINFO_EXTENSION);
        $target_file = $path . basename($fileName);
        move_uploaded_file($data['profile_pic']['tmp_name'], $target_file);
        $sql = "UPDATE user SET ProfilePicture = :photo WHERE UserId = :id";
        $fileUrl = "/ezvote/public/upload/profile_pictures/".$fileName;
        $this->db->query($sql);
        $this->db->bind(':photo', $fileUrl);
        $this->db->bind(':id', $data['id']);
        try{
            $this->db->execute();
            $_SESSION['profile_picture'] = $fileUrl;
        }
        catch (Exception $e){
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }
    public function getUserByUserId($id){
        $this->db->query("SELECT * FROM `user` WHERE UserId =:userID");
        $this->db->bind(':userID',$id);
        $results=$this->db->resultSet();
        return $results;
    }  


}