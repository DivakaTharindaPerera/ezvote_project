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

    public function getPartiesByElectionId($id){
        $this->db->query(
            "SELECT * FROM ElectionParty WHERE electionId = :id"
        );
        $this->db->bind(':id', $id);
        $result = $this->db->resultSet();
        return $result;
    }

    public function getPartyById($id){
        $this->db->query(
            "SELECT * FROM ElectionParty WHERE partyId = :id"
        );
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        return $result;
    }

    public function findDuplicateParty($eid,$pName){
        $this->db->query(
            "SELECT * FROM ElectionParty WHERE electionId = :eid AND partyName = :pName"
        );
        $this->db->bind(':eid', $eid);
        $this->db->bind(':pName', $pName);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function editPartyWithUser($data){
        $this->db->query(
            "UPDATE ElectionParty SET 
            partyName = :1, 
            electionId = :2, 
            supName = :3, 
            supEmail = :4, 
            userId = :5 
            WHERE partyId = :6"
        );
        $this->db->bind(':1', $data['partyName']);
        $this->db->bind(':2', $data['eid']);
        $this->db->bind(':3', $data['supName']);
        $this->db->bind(':4', $data['supEmail']);
        $this->db->bind(':5', $data['userId']);
        $this->db->bind(':6', $data['partyId']);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
            return false;
        }
    }

    public function editPartyWithoutUser($data){
        $this->db->query(
            "UPDATE ElectionParty SET 
            partyName = :1, 
            electionId = :2, 
            supName = :3, 
            supEmail = :4 
            WHERE partyId = :5"
        );
        $this->db->bind(':1', $data['partyName']);
        $this->db->bind(':2', $data['eid']);
        $this->db->bind(':3', $data['supName']);
        $this->db->bind(':4', $data['supEmail']);
        $this->db->bind(':5', $data['partyId']);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
            return false;
        }
    }

    public function deletePartyByPartyId($partyId){
        $this->db->query(
            "DELETE FROM ElectionParty WHERE partyId = :partyId"
        );
        $this->db->bind(':partyId', $partyId);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
            return false;
        }
    }
}

