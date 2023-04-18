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

    public function insertRegCandidatePartyNull($data){
        $this->db->query(
            "INSERT INTO Candidate
            (candidateName, candidateEmail, electionId, positionId, userId)
            VALUES(:1,:2,:3,:4,:6)
            "
        );

        $this->db->bind(':1', $data['candidateName']);
        $this->db->bind(':2', $data['candidateEmail']);
        $this->db->bind(':3', $data['electionId']);
        $this->db->bind(':4', $data['positionId']);
        $this->db->bind(':6', $data['userId']);

        try {
            $this->db->execute();
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
            return false;
        }
    }

    public function insertUnregCandidatePartyNull($data){
        $this->db->query(
            "INSERT INTO Candidate
            (candidateName, candidateEmail, electionId, positionId)
            VALUES(:1,:2,:3,:4)
            "
        );

        $this->db->bind(':1', $data['candidateName']);
        $this->db->bind(':2', $data['candidateEmail']);
        $this->db->bind(':3', $data['electionId']);
        $this->db->bind(':4', $data['positionId']);
        
        
        try {
            $this->db->execute();
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
            return false;
        }
    }

    public function getCandidatesByElectionId($id){
//        $id=1281;
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

    public function updateCandidate($data){
        $this->db->query(
            "UPDATE Candidate
            SET candidateName = :1, candidateEmail = :2, partyId = :3
            WHERE candidateId = :4"
        );
        $this->db->bind(':1', $data['cname']);
        $this->db->bind(':2', $data['cemail']);
        $this->db->bind(':3', $data['cparty']);
        $this->db->bind(':4', $data['cid']);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
        }
    }

    public function updateCandidateWithUser($data){
        $this->db->query(
            "UPDATE Candidate
            SET candidateName = :1, candidateEmail = :2, partyId = :3, userId = :4
            WHERE candidateId = :5"
        );
        $this->db->bind(':1', $data['cname']);
        $this->db->bind(':2', $data['cemail']);
        $this->db->bind(':3', $data['cparty']);
        $this->db->bind(':4', $data['cuser']);
        $this->db->bind(':5', $data['cid']);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
        }
    }

    public function getCandidateByCandidateId($id){
        $this->db->query(
            "SELECT * FROM Candidate
            WHERE candidateId = :1
            "
        );
        $this->db->bind(':1', $id);
        try {
            $this->db->execute();
            return $this->db->single();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
        }
    }
}