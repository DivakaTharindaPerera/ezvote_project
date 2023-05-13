<?php

class log extends Controller{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function saveLog($text,$eid,$uid){
        $date = date('Y-m-d');
        $time = date('H:i:s');

        $this->db->query('INSERT INTO logs(description , Date, Time, electionId, userId) VALUES (:text, :date, :time, :eid, :uid)');
        $this->db->bind(':text', $text);
        $this->db->bind(':date', $date);
        $this->db->bind(':time', $time);
        $this->db->bind(':eid', $eid);
        $this->db->bind(':uid', $uid);

        try{
            $this->db->execute();
            return true;
        }catch(Exception $e){
            return $e->getMessage();
        }

    }

    public function getLogsByElectionId($eid){
        $this->db->query('SELECT * FROM logs WHERE electionId = :eid');
        $this->db->bind(':eid', $eid);

        try {
            return $this->db->resultSet();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}