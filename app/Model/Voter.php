<?php



//session_start();


class Voter extends Controller{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function insertIntoRegVoters($data){

        $this->db->query(
            "INSERT INTO Voter(Email, Name, electionId, value, userId)
            VALUES(:1,:2,:3,:4,:5)"
        );

        // $this->db->query(
        //     "INSERT INTO registered_voter
        //     (ElectionId, UserId, value)
        //     VALUES(:1,:2,:3)"
        // );

        $this->db->bind(':1', $data['email']);
        $this->db->bind(':2', $data['name']);
        $this->db->bind(':3', $data['electionId']);
        $this->db->bind(':4', $data['value']);
        $this->db->bind(':5', $data['id']);
        

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
                "INSERT INTO Voter(Email, Name, electionId, value)
                VALUES(:1,:2,:3,:4)"
            );

            // $this->db->query(
            //     "INSERT INTO unregistered_voter
            //     (ElectionId, Email, name, value)
            //     VALUES(:1,:2,:3,:4)"
            // );
    
            $this->db->bind(':1', $data['email']);
            $this->db->bind(':2', $data['name']);
            $this->db->bind(':3', $data['electionId']);
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

    public function getRegVoterByUserId($id){
        $this->db->query(
            "SELECT * FROM registered_voter
            WHERE UserId = :1"
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

    public function findRegVoterByUserIdAndElectionId($uid,$eid){
        $this->db->query(
            "SELECT * FROM registered_voter
            WHERE UserId = :1 AND ElectionId = :2"
        );

        $this->db->bind(':1', $uid);
        $this->db->bind(':2', $eid);

        try {
            $row= $this->db->single();
            if( $this->db->rowCount() > 0){
                //voter exists
                return true;
            }else{
                //voter not exists
                return false;
            }
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            die();
        }
    }
    public function findUnRegVoterByEmailAndElectionId($email,$eid){
        $this->db->query(
            "SELECT * FROM unregistered_voter
            WHERE Email = :1 AND ElectionId = :2"
        );

        $this->db->bind(':1', $email);
        $this->db->bind(':2', $eid);

        try {
            $row= $this->db->single();
            if( $this->db->rowCount() > 0){
                //voter exists
                return true;
            }else{
                //voter not exists
                return false;
            }
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            die();
        }
    }

    public function deleteUnregVoterByEmailAndElectionId($email,$eid){
        $this->db->query(
            "DELETE FROM unregistered_voter
            WHERE ElectionId = :1 AND Email = :2"
        );

        $this->db->bind(':1', $eid);
        $this->db->bind(':2', $email);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }

    public function deleteRegVoterByUserIdAndElectionId($uid,$eid){
        $this->db->query(
            "DELETE FROM registered_voter
            WHERE ElectionId = :1 AND UserId = :2"
        );

        $this->db->bind(':1', $eid);
        $this->db->bind(':2', $uid);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }

    public function editUnregVoter($data){
        $this->db->query(
            "UPDATE unregistered_voter
            SET name = :1, value = :2, Email = :5
            WHERE ElectionId = :3 AND Email = :4"
        );

        $this->db->bind(':1', $data['name']);
        $this->db->bind(':2', $data['value']);
        $this->db->bind(':3', $data['eid']);
        $this->db->bind(':4', $data['oldEmail']);
        $this->db->bind(':5', $data['email']);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }
}