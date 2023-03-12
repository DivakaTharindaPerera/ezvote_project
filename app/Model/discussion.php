<?php

// class DiscussionModel extends Model{
//     public function insertComment($id, $name, $msg) {
//         //include 'conn.php';
//         if($name != "" && $msg != ""){
//             $this->db->query("INSERT INTO discussion (parent_comment, student, post) VALUES ('$id', '$name', '$msg')");
//             // $sql = $conn->query("INSERT INTO discussion (parent_comment, student, post) VALUES ('$id', '$name', '$msg')");
//             $status = 200;
//         }
//         else{
//             $status = 201;
//         }
//         $this->db = null;
//         return $status;
//     }
// }




// class Discussion extends Model
// {
//     protected $Student='';
//     protected $Post='';
//     protected $Date;

//     public function AddDiscussion($data){
//         $this->db->query('INSERT INTO discussion (Student,Post,Date) VALUES (:Student,:Post,:Date)');
//         //bind values
//         $this->db->bind(':Student',$data['Student']);
//         $this->db->bind(':Post',$data['Post']);
//         $this->db->bind(':Date',$data['Date']);

//         //execute
//         if($this->db->execute()){
//             return true;
//         }else{
//             return false;
//         }
//     }
// }


class Discussion{

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

public function viewDiscussion(){
$data = array();
$sql = "SELECT *  FROM `discussion` ORDER BY id desc";
$result = $this->db->query($sql);
while($row = $result->fetchAll()){
        array_push($data, $row);
        array_push($data);
}


echo json_encode($data);
$this->db = null;
exit();


}

public function insertPost(){
$id = $_POST['id'];
$name = $_POST['name'];
$msg = $_POST['msg'];
if($name != "" && $msg != ""){
	$sql = $this->db->query("INSERT INTO discussion (parent_comment, student, post)
			VALUES ('$id', '$name', '$msg')");
	echo json_encode(array("statusCode"=>200));
}
else{
	echo json_encode(array("statusCode"=>201));
}
$this->db = null;

}
}