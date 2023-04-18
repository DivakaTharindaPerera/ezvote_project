<?php 

class Voting extends Controller{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getVoterByUidAndEid($uid, $eid){
        $this->db->query("SELECT * FROM Voter WHERE userId = :uid AND electionId = :eid");
        $this->db->bind(':uid', $uid);
        $this->db->bind(':eid', $eid);

        $row = $this->db->single();

        return $row;
    }

    public function checkForVoter($uid,$eid){
        $this->db->query("SELECT * FROM Voter WHERE userId = :uid AND electionId = :eid");
        $this->db->bind(':uid', $uid);
        $this->db->bind(':eid', $eid);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function castVote($vid){
        $this->db->query("UPDATE Voter SET cast= 1 WHERE voterId = :vid");

        $this->db->bind(':vid', $vid);

        try{
            $this->db->execute();
            return true;
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function alreadyVoted($uid,$eid){
        $this->db->query("SELECT * FROM Voter WHERE userId = :uid AND electionId = :eid AND cast = 1");
        $this->db->bind(':uid', $uid);
        $this->db->bind(':eid', $eid);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}