<?php 

class Payments{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function checkTransaction($transaction_id){
        $this->db->query('SELECT paymentID from payment WHERE transactionID = :transactionID');

        $this->db->bind(':transactionID',$transaction_id);
        return $this->db->resultSet();
    }

    public function addTransaction($id,$username,$email,$name,$price,$transaction_id,$status,$plan,$user){
        $this->db->query('INSERT INTO payment(paymentID,userName,userEmail,planName,planPrice,transactionID,paymentStatus,planID,UserId) VALUES (:paymentID, :userName, :userEmail, :planName, :price, :transactionID, :paymentStatus, :planID, :UserId)');

        $this->db->bind(':paymentID',$id);
        $this->db->bind(':userName',$username);
        $this->db->bind(':userEmail',$email);
        $this->db->bind(':planName',$name);
        $this->db->bind(':price',$price);
        $this->db->bind(':transactionID',$transaction_id);
        $this->db->bind(':paymentStatus',$status);
        $this->db->bind(':planID',$plan);
        $this->db->bind(':UserId',$user);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }    
    }

    public function getTransaction($transaction_id){
        $this->db->query('SELECT paymentID,userName,userEmail,planName,planPrice,transactionID,paymentStatus,planID,UserId FROM payment WHERE transactionID = :transactionID');

        $this->db->bind(':transactionID',$transaction_id);
        return $this->db->resultSet();
    }

}
?>