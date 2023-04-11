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
}