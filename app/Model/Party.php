<?php

class Party extends Controller{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function insertIntoParty1($data){
        //for the unregistered party supervisor
        $this->db->query(
                "INSERT INTO ElectionParty 
                ( partyName, 
                electionId, supName, supEmail) 
                VALUES(:1,:2,:3,:4)"
            );
        $this->db->bind(':1', $data['partyName']);
        $this->db->bind(':2', $data['electionId']);
        $this->db->bind(':3', $data['supName']);
        $this->db->bind(':4', $data['supEmail']);
        
        try {
            $this->db->execute();
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
            return false;
        }
    }

    public function insertIntoParty2($data){
        //for the registered party supervisor
        $this->db->query(
                "INSERT INTO ElectionParty 
                ( partyName, 
                electionId, supName, supEmail, userId) 
                VALUES(:1,:2,:3,:4,:5)"
            );
        $this->db->bind(':1', $data['partyName']);
        $this->db->bind(':2', $data['electionId']);
        $this->db->bind(':3', $data['supName']);
        $this->db->bind(':4', $data['supEmail']);
        $this->db->bind(':5', $data['userId']);

        try {
            $this->db->execute();
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
            return false;
        }
    }
}

