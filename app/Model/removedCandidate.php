<?php

class removedCandidate extends Controller{
    private $db;
    private $logModel;

    public function __construct(){
        $this->db = new Database;
        $this->logModel = $this->model('log');
    }

    public function addRemovedCandidate($data){
        $this->db->query('INSERT INTO RemovedCandidate (candidateId,candidateEmail,candidateName,electionId,positionId) VALUES (:id,:email,:name,:eid,:pid)');
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':eid',$data['eid']);
        $this->db->bind(':pid',$data['pid']);

        try{
            $this->db->execute();
            return true;
        }catch(Exception $e){
            die($e->getMessage());
        }
    
    }
}