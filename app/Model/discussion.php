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

            $this->db->query("INSERT INTO `discussion` (parent_comment, student, post) VALUES (:parent_comment,:student,:post)");
            $this->db->bind(':parent_comment', intVal($data['id']));
            $this->db->bind(':student', $data['name']);
            $this->db->bind(':post', $data['msg']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }



    public function viewDiscussion($data = [])
    {

        $this->db->query("SELECT * FROM `discussion` ORDER BY id desc");
        $result = $this->db->resultSet();
        return $result;
    }
}
