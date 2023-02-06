<?php

class electionPositions{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getElectionPositions(){
        $this->db->query("SELECT * FROM ElectionPosition;");

        return $this->db->resultSet();
    }

    public function getElectionPositionById($id){
        $this->db->query("SELECT * FROM ElectionPosition WHERE id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }

    public function getElectionPositionByElectionId($id){
        $this->db->query("SELECT * FROM ElectionPosition WHERE ElectionID = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->resultSet();

        return $row;
    }

    public function insertIntoElectionPositions($data){
        $this->db->query(
                "INSERT INTO ElectionPosition
                ( positionName, description, ElectionID, NoofOptions) 
                VALUES(:1,:2,:3,:4)"
            );
            // $data = [
            //     'electionId' => $electionId,
            //     'position' => trim($_POST[$i."positionName"]),
            //     'description' => trim($_POST[$i."desc"]),
            //     'noOfOptions' => trim($_POST[$i."noOfOptions"]),
            //     'count' => $count
            // ];  
        $this->db->bind(':1', $data['position']);
        $this->db->bind(':2', $data['description']);
        $this->db->bind(':3', $data['electionId']);
        $this->db->bind(':4', $data['noOfOptions']);

        try{
            $this->db->execute();
            return $this->db->lastInsertId();
        }catch(Exception $e){
            echo "Something went wrong :".$e->getMessage();
            return false;
        }

    }
}