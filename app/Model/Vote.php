<?php 

class Vote extends Controller{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function saveVote($vid,$cid,$pid){
        $this->db->query('INSERT INTO Vote (voter, candidate, positionId) VALUES (:vid, :cid, :pid)');
        $this->db->bind(':vid', $vid);
        $this->db->bind(':cid', $cid);
        $this->db->bind(':pid', $pid);

        try{
            $this->db->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}