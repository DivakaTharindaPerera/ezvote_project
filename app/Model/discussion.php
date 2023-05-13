<?php


class Discussion
{

    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }


    public function insertPost($data)
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $msg = $_POST['msg'];

        if ($name != "" && $msg != "") {

            $this->db->query("INSERT INTO `discussion` (parent_comment, student, post,ElectionID,CandidateID,VoterID) VALUES (:parent_comment,:student,:post,:electionId,:candidateId,:voterId)");
            $this->db->bind(':parent_comment', intVal($data['id']));
            $this->db->bind(':student', $data['name']);
            $this->db->bind(':post', $data['msg']);
            $this->db->bind(':electionId', $data['elect_id']);
            $this->db->bind(':candidateId', $data['candidate_id']);
            $this->db->bind(':voterId', $data['voter_id']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }



    public function viewDiscussion($id1,$id2)
    {

        $this->db->query("SELECT * FROM `discussion` WHERE ElectionID=$id1 AND CandidateID=$id2 ORDER BY id desc");
        $result = $this->db->resultSet();
        return $result;
    }
}
