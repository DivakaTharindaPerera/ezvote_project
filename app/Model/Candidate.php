<?php


//session_start();


class Candidate extends Controller{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function insertRegCandidate($data){
        $this->db->query(
            "INSERT INTO Candidate
            (candidateName, candidateEmail, electionId, positionId, partyId ,userId)
            VALUES(:1,:2,:3,:4,:5,:6)
            "
        );

        $this->db->bind(':1', $data['candidateName']);
        $this->db->bind(':2', $data['candidateEmail']);
        $this->db->bind(':3', $data['electionId']);
        $this->db->bind(':4', $data['positionId']);
        $this->db->bind(':5', $data['partyId']);
        $this->db->bind(':6', $data['userId']);

        try {
            $this->db->execute();
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
            return false;
        }
    }

    public function insertUnregCandidate($data){
        $this->db->query(
            "INSERT INTO Candidate
            (candidateName, candidateEmail, electionId, positionId, partyId)
            VALUES(:1,:2,:3,:4,:5)
            "
        );

        $this->db->bind(':1', $data['candidateName']);
        $this->db->bind(':2', $data['candidateEmail']);
        $this->db->bind(':3', $data['electionId']);
        $this->db->bind(':4', $data['positionId']);
        $this->db->bind(':5', $data['partyId']); 
        
        try {
            $this->db->execute();
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
            return false;
        }
    }
    public function getCandidatesByElectionId($id){
        $this->db->query(
            "SELECT * FROM Candidate
            WHERE electionid = :1
            "
        );
        $this->db->bind(':1', $id);
        try {
            $this->db->execute();
            return $this->db->resultSet();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
        }
    }

    public function deleteCandidate($id){
        $this->db->query(
            "DELETE FROM Candidate
            WHERE candidateId = :1
            "
        );
        $this->db->bind(':1', $id);
        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
            return false;
        }
    }
}