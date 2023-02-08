<?php



//session_start();


class Voter extends Controller{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function insertIntoRegVoters($data){


        $this->db->query(
            "INSERT INTO registered_voter
            (ElectionId, UserId, value)
            VALUES(:1,:2,:3)"
        );

        $this->db->bind(':1', $data['electionId']);
        $this->db->bind(':2', $data['id']);
        $this->db->bind(':3', $data['value']);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }

    public function insertIntoUnregVoters($data){
            
            $this->db->query(
                "INSERT INTO unregistered_voter
                (ElectionId, Email, name, value)
                VALUES(:1,:2,:3,:4)"
            );
    
            $this->db->bind(':1', $data['electionId']);
            $this->db->bind(':2', $data['email']);
            $this->db->bind(':3', $data['name']);
            $this->db->bind(':4', $data['value']);
    
            try {
                $this->db->execute();
                return true;
            } catch (Exception $e) {
                echo "Something went wrong ".$e->getMessage();
                return false;
            }

    }

    public function getRegVotersByElectionId($id){
        $this->db->query(
            "SELECT * FROM registered_voter
            WHERE ElectionId = :1"
        );

        $this->db->bind(':1', $id);

        try {
            $result = $this->db->resultSet();
            return $result;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }

    public function getUnregVotersByElectionId($id){
        $this->db->query(
            "SELECT * FROM unregistered_voter
            WHERE ElectionId = :1"
        );

        $this->db->bind(':1', $id);

        try {
            $result = $this->db->resultSet();
            return $result;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }
}