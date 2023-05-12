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
            "SELECT * FROM Voter
            WHERE electionId = :1 AND userId is NOT NULL"
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
            "SELECT * FROM Voter
            WHERE electionId = :1 AND userId is NULL"
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

    public function deleteVoterByVoterId($id){
        $this->db->query(
            "DELETE FROM Voter
            WHERE voterId = :1"
        );

        $this->db->bind(':1', $id);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
        }
    }

    // public function getRegVoterByUserId($id){
    //     $this->db->query(
    //         "SELECT * FROM Voter
    //         WHERE userId = :1"
    //     );

    //     $this->db->bind(':1', $id);

    //     try {
    //         $result = $this->db->resultSet();
    //         return $result;
    //     } catch (Exception $e) {
    //         echo "Something went wrong ".$e->getMessage();
    //         return false;
    //     }
    // }

    public function findRegVoterByUserIdAndElectionId($uid,$eid){
        $this->db->query(
            "SELECT * FROM Voter
            WHERE userId = :1 AND ElectionId = :2"
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

    public function findDuplicateVoters($email,$eid){
        $this->db->query(
            "SELECT * FROM Voter
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

    // public function findUnRegVoterByEmailAndElectionId($email,$eid){
    //     $this->db->query(
    //         "SELECT * FROM Voter
    //         WHERE Email = :1 AND ElectionId = :2"
    //     );

    //     $this->db->bind(':1', $email);
    //     $this->db->bind(':2', $eid);

    //     try {
    //         $row= $this->db->single();
    //         if( $this->db->rowCount() > 0){
    //             //voter exists
    //             return true;
    //         }else{
    //             //voter not exists
    //             return false;
    //         }
    //     } catch (Exception $e) {
    //         echo "Something went wrong ".$e->getMessage();
    //         die();
    //     }
    // }

    // public function deleteUnregVoterByEmailAndElectionId($email,$eid){
    //     $this->db->query(
    //         "DELETE FROM unregistered_voter
    //         WHERE ElectionId = :1 AND Email = :2"
    //     );

    //     $this->db->bind(':1', $eid);
    //     $this->db->bind(':2', $email);

    //     try {
    //         $this->db->execute();
    //         return true;
    //     } catch (Exception $e) {
    //         echo "Something went wrong ".$e->getMessage();
    //         return false;
    //     }
    // }

    // public function deleteRegVoterByUserIdAndElectionId($uid,$eid){
    //     $this->db->query(
    //         "DELETE FROM registered_voter
    //         WHERE ElectionId = :1 AND UserId = :2"
    //     );

    //     $this->db->bind(':1', $eid);
    //     $this->db->bind(':2', $uid);

    //     try {
    //         $this->db->execute();
    //         return true;
    //     } catch (Exception $e) {
    //         echo "Something went wrong ".$e->getMessage();
    //         return false;
    //     }
    // }

    // public function editUnregVoter($data){
    //     $this->db->query(
    //         "UPDATE unregistered_voter
    //         SET name = :1, value = :2, Email = :5
    //         WHERE ElectionId = :3 AND Email = :4"
    //     );

    //     $this->db->bind(':1', $data['name']);
    //     $this->db->bind(':2', $data['value']);
    //     $this->db->bind(':3', $data['eid']);
    //     $this->db->bind(':4', $data['oldEmail']);
    //     $this->db->bind(':5', $data['email']);

    //     try {
    //         $this->db->execute();
    //         return true;
    //     } catch (Exception $e) {
    //         echo "Something went wrong ".$e->getMessage();
    //         return false;
    //     }
    // }

    public function editVoterWithoutUser($data){
        $this->db->query(
            "UPDATE Voter
            SET Name = :1, value = :2, Email = :3, userId = NULL
            WHERE voterId = :4"
        );

        $this->db->bind(':1', $data['name']);
        $this->db->bind(':2', $data['value']);
        $this->db->bind(':3', $data['email']);
        $this->db->bind(':4', $data['id']);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }

    public function editVoterWithUser($data){
        $this->db->query(
            "UPDATE Voter
            SET Name = :1, value = :2, Email = :3, userId = :4
            WHERE voterId = :5"
        );

        $this->db->bind(':1', $data['name']);
        $this->db->bind(':2', $data['value']);
        $this->db->bind(':3', $data['email']);
        $this->db->bind(':4', $data['uid']);
        $this->db->bind(':5', $data['id']);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }

    // public function addTemporaryVoting()
    // {
    //     $this->db->query();
    // }
    // public function deleteTemporaryVoting()
    // {
    //     $this->db->query();
    // }

    public function getVoterByUserId($id){
        $this->db->query("SELECT * FROM voter WHERE UserId = '" .$id."' ");

//        $this->db->bind(':1', $id);

        try {
            $result = $this->db->single();
            return $result;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }

    public function getVotersByUserId($id){
        $this->db->query("SELECT * FROM Voter WHERE UserId = :1");
        $this->db->bind(':1', $id);

        try {
            $result = $this->db->resultSet();
            return $result;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            // return false;
        }
    }

    // public function checkVoterAuthentication($vid,$eid){
    //     $this->db->query("SELECT * FROM Voter WHERE userId= :1 AND ElectionId = :2");
    //     $this->db->bind(':1', $vid);
    //     $this->db->bind(':2', $eid);


    // }

    public function updateVoterOtp($data){
        $this->db->query(
            "UPDATE Voter
            SET OTP = :1
            WHERE electionId = :2 AND userId = :3"
        );
        $this->db->bind(':1', $data['otp']);
        $this->db->bind(':2', $data['eid']);
        $this->db->bind(':3', $data['uid']);

        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }

    }

    public function getVoterByUserIdAndElectionId($uid,$eid){
        $this->db->query("SELECT * FROM Voter WHERE userId= :1 AND electionId = :2");
        $this->db->bind(':1', $uid);
        $this->db->bind(':2', $eid);

        try {
            $result = $this->db->single();
            return $result;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }

    public function getVoterByVoterId($vid){
        $this->db->query("SELECT * FROM Voter WHERE voterId= :1");
        $this->db->bind(':1', $vid);

        try {
            $result = $this->db->single();
            return $result;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }

    public function getVotersByElectionId($eid){
        $this->db->query("SELECT * FROM Voter WHERE electionId= :1");
        $this->db->bind(':1', $eid);

        try {
            $result = $this->db->resultSet();
            echo $this->db->rowCount();
            return $result;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
        }
    }


    public function sendEmailVoters($voterId,$data)
    {
        $this->db->query(
            "SELECT Email FROM voter WHERE voterId = :1");
        $this->db->bind(':1', $voterId);
        $this->db->execute();
        $voter = $this->db->single();
        $email = new Email();
        $data = [
            'email' => $voter->Email,
            'subject' => 'You have a meeting',
            'body' => 'You have a meeting with supervisor.<br>
                            Topic-' . $data['topic'] . '<br>
                            Date-' . $data['start_date'] . '<br>
                            Password-' . $data['password'] . '<br>
                            Please be sure to log on ezvote platform to attend the meeting.'
        ];

        $email->sendEmail($data);
    }

    public function findRegVoterByVoterIdAndElectionId($vid,$eid){
        $this->db->query(
            "SELECT * FROM Voter
            WHERE voterId = :1 AND ElectionId = :2"
        );

        $this->db->bind(':1', $vid);
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

    public function findVoterByUserIdAndElectionId($uid,$eid){
        // var_dump($uid);
        // var_dump($eid);
        // exit;
        $this->db->query(
            "SELECT * FROM Voter
            WHERE userId = :1 AND ElectionId = :2"
        );

        $this->db->bind(':1', $uid);
        $this->db->bind(':2', $eid);

        try {
            $row= $this->db->single();
            return $row;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            die();
        }

    }

    public function insertQuestion()
    {
        $this->db->query("INSERT INTO discussion1 (question, electionId,candidateId)VALUES (:1, :2,:3)");
        $this->db->bind(':1', $_POST['question']);
        $this->db->bind(':2', $_POST['electionId']);
        $this->db->bind(':3', $_POST['candidateId']);
        $this->db->execute();
        return true;
    }

    
}