<?php


//session_start();


class Candidate extends Controller
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function insertRegCandidate($data)
    {
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
            echo "Something went wrong :" . $e->getMessage();
            return false;
        }
    }

    public function insertUnregCandidate($data)
    {
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
            echo "Something went wrong :" . $e->getMessage();
            return false;
        }
    }

    public function insertRegCandidatePartyNull($data)
    {
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
            echo "Something went wrong :" . $e->getMessage();
            return false;
        }
    }

    public function insertUnregCandidatePartyNull($data)
    {
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
            echo "Something went wrong :" . $e->getMessage();
            return false;
        }
    }

    public function getCandidatesByElectionId($id)
    {
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
            echo "Something went wrong :" . $e->getMessage();
        }
    }


    public function deleteCandidate($id)
    {

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
            echo "Something went wrong :" . $e->getMessage();
            return false;
        }
    }

    public function updateCandidate($data)
    {
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
            echo "Something went wrong :" . $e->getMessage();
        }
    }


    public function updateCandidateWithUser($data)
    {
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
            echo "Something went wrong :" . $e->getMessage();
        }
    }

    public function getCandidateByCandidateId($id)
    {
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
            echo "Something went wrong :" . $e->getMessage();
        }
    }


    public function getCandidatesByEmailAndElectionId($email, $eid)
    {
        $this->db->query(
            "SELECT * FROM Candidate
            WHERE candidateEmail = :1 AND electionid = :2
            "
        );
        $this->db->bind(':1', $email);
        $this->db->bind(':2', $eid);
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            echo "Something went wrong :" . $e->getMessage();
        }
    }

    public function sendEmailCandidates($candidateId,$data){
        $this->db->query(
            "SELECT candidateEmail FROM Candidate WHERE candidateId = :1"
        );
        $this->db->bind(':1', $candidateId);
        $this->db->execute();
        $candidate = $this->db->single();
        $email = new Email();
        $data = [
            'email' => $candidate->candidateEmail,
            'subject' => 'You have a meting',
            'body' => 'You have a meeting with supervisor.<br>
                            Topic-' . $data['topic'] . '<br>
                            Date-' . $data['start_date'] . '<br>
                            Password-' . $data['password'] . '<br>
                            Please be sure to log on ezvote platform to attend the meeting.'
        ];

        $email->sendEmail($data);
    }


    public function getCandidateByUserId()
    {
        $this->db->query('SELECT * FROM candidate WHERE userId = :user_id');
        $this->db->bind(':user_id', $_SESSION['UserId']);
        $this->db->execute();
        $candidate = $this->db->resultSet();
        return $candidate;
    }


    public function getCandidateProfile($candidate_id)
    {
        // var_dump($candidate_id);
        // exit;
        $this->db->query("SELECT * FROM Candidate WHERE candidateId = $candidate_id");

        try {
            $this->db->execute();
            return $this->db->resultSet();
        } catch (Exception $e) {
            echo "Something went wrong :" . $e->getMessage();
        }
    }



    public function getCandidateProfileByUserId($candidate_id)
    {
        // var_dump($candidate_id);
        // exit;

        $this->db->query("SELECT * FROM Candidate WHERE userId = $candidate_id");

        try {
            $this->db->execute();
            return $this->db->resultSet();
        } catch (Exception $e) {
            echo "Something went wrong :" . $e->getMessage();
        }
    }

    public function getCandidateByUser($user_id)
    {
        // var_dump($candidate_id);
        // exit;

        $this->db->query("SELECT * FROM Candidate WHERE userId = $user_id");

        try {
            $this->db->execute();
            return $this->db->resultSet();
        } catch (Exception $e) {
            echo "Something went wrong :" . $e->getMessage();
        }
    }


    public function updateCandidateProfile($data)
    {
        
        if (empty($data['profilePicture'])) {
            $data['profilePicture']=$data['profile'];
        }
        if (empty($data['identityProof'])) {
            $data['identityProof']=$data['identity'];
        }

        $this->db->query("UPDATE `Candidate` SET candidateName=:candidateName, `description`=:description, `profile_picture`=:image_url,`identity_proof`=:file_url,vision=:vision WHERE candidateId = :candidateId");
        $this->db->bind(':candidateId', $data['candidateId']);
        $this->db->bind(':candidateName', $data['candidateName']);
        $this->db->bind(':image_url',$data['profilePicture']);
        $this->db->bind(':file_url',$data['identityProof']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':vision', $data['vision']);
        if ($this->db->execute()) {
               return true;
        }
        else{
         	return false;
        }
    }

    public function findCandidateByUserIdAndCandidateId($uid, $cid)
    {
        $this->db->query(
            "SELECT * FROM Candidate
            WHERE userId = :1 AND candidateId = :2
            "
        );
        $this->db->bind(':1', $uid);
        $this->db->bind(':2', $cid);
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            echo "Something went wrong :" . $e->getMessage();
        }
    }
    
    public function findCandidateByUserIdAndElectionId($uid, $eid)
    {
        $this->db->query(
            "SELECT * FROM Candidate
            WHERE userId = :1 AND electionid = :2
            "
        );
        $this->db->bind(':1', $uid);
        $this->db->bind(':2', $eid);
        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            echo "Something went wrong :" . $e->getMessage();
        }
    }

    public function getCandidateEmail($candidateId)
    {
        $this->db->query(
            "SELECT candidateEmail FROM Candidate WHERE candidateId = :1"
        );
        $this->db->bind(':1', $candidateId);
        $this->db->execute();
        $candidate = $this->db->single();
        return $candidate;
    }

}

