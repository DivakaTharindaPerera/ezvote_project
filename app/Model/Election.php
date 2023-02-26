<?php 


//session_start();



class Election extends Controller{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function insertIntoElection($data){
        $this->db->query(
                "INSERT INTO Election 
                ( OrganizationName,Title, 
                StartDate, EndDate, 
                Description,StatVisibality, 
                SelfNomination, 
                StartTime, EndTime, ObjectionStatus,
                ObjectionStartDate, ObjectionEndDate,
                ObjectionStartTime, ObjectionEndTime, 
                NominationDescription, 
                Supervisor) 
                VALUES(:1,:2,:3,:4,:5,:6,:7,:8,:9,:10,:11,:12,:13,:14,:15,:16)"
            );

        $this->db->bind(':1', $data['orgname']);
        $this->db->bind(':2', $data['title']);
        $this->db->bind(':3', $data['esd']);
        $this->db->bind(':4', $data['eed']);
        $this->db->bind(':5', $data['description']);
        $this->db->bind(':6', $data['stat']);
        $this->db->bind(':7', $data['sn']);
        $this->db->bind(':8', $data['est']);
        $this->db->bind(':9', $data['eet']);
        $this->db->bind(':10', $data['obj']);
        $this->db->bind(':11', $data['osd']);
        $this->db->bind(':12', $data['oed']);
        $this->db->bind(':13', $data['ost']);
        $this->db->bind(':14', $data['oet']);
        $this->db->bind(':15', $data['nomi_description']);
        $this->db->bind(':16', $_SESSION["UserId"]);

        try {
            $this->db->execute();
            $data['id'] = $this->db->lastInsertId();
            $this->view('Supervisor/addVoters', $data);
            
        } catch (Exception $e) {
            echo "Something went wrong";
        }return false;


    }
    public function findElectionById($id){
        $this->db->query("SELECT * FROM Election WHERE ElectionId = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
    //get all the elections created by the user.
    public function getElectionsByUserId($id){
        $this->db->query("SELECT * FROM Election WHERE Supervisor = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->resultSet();
        return $row;
    }

    public function getElectionByElectionId($id){
        $this->db->query("SELECT * FROM Election WHERE ElectionId = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function getElectionsByUserIdSorted($id, $method){
        
        if($method == "asc"){
            
            $this->db->query("SELECT * FROM Election WHERE Supervisor = :id ORDER BY Title ASC");
            $this->db->bind(':id', $id);
            $row = $this->db->resultSet();
            return $row;
        }
        if($method == "desc"){
            
            $this->db->query("SELECT * FROM Election WHERE Supervisor = :id ORDER BY Title DESC");
            $this->db->bind(':id', $id);
            $row = $this->db->resultSet();
            return $row;
        }
        if($method == "Dasc"){
            
            $this->db->query("SELECT * FROM Election WHERE Supervisor = :id ORDER BY StartDate ASC");
            $this->db->bind(':id', $id);
            $row = $this->db->resultSet();
            return $row;
        }
        if($method == "Ddesc"){
            
            $this->db->query("SELECT * FROM Election WHERE Supervisor = :id ORDER BY StartDate DESC");
            $this->db->bind(':id', $id);
            $row = $this->db->resultSet();
            return $row;
        }
        
    }

    public function getOngoingElections()
    {
        date_default_timezone_set("Asia/Colombo");
        $dates=date("Y-m-d");
        $times=date("H:i:s");
        $this->db->query(
            "SELECT * FROM election WHERE StartDate<='".$dates."' && StartTime<='".$times."' && EndDate>='".$dates."' && EndTime>='".$times."'"
        );
        try {
            $result = $this->db->resultSet();
            return $result;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;
        }
    }

    public function getUpcomingElections()
    {
        $dates=date("Y-m-d");
        $times=date("H:i:s");
        $this->db->query(
            "SELECT * FROM election WHERE (StartDate='".$dates."' && StartTime>'".$times."') ||(StartDate>'".$dates."' && StartTime>='".$times."')|| (StartDate>'".$dates."' && StartTime<'".$times."') "
        );
        try {
            $result = $this->db->resultSet();
            return $result;
        } catch (Exception $e) {
            echo "Something went wrong ".$e->getMessage();
            return false;

        }
    }
    public function getCompletedElections()
    {
        $dates = date("Y-m-d");
        $times = date("H:i:s");
        $this->db->query(
            "SELECT * FROM election WHERE (EndDate='" . $dates . "' && EndTime<'" . $times . "') ||(EndDate<'" . $dates . "' && EndTime>='" . $times . "') || (EndDate<'" . $dates . "' && EndTime<'" . $times . "')"
        );
        try {
            $result = $this->db->resultSet();
            return $result;
        } catch (Exception $e) {
            echo "Something went wrong " . $e->getMessage();
            return false;

        }
    }

    public function getPositionsByElectionId($id){
        $election_Id=$id;
        $this->db->query("SELECT DISTINCT positionName FROM electionposition WHERE ElectionID ='" .$election_Id. "'" );
        $this->db->bind(':id', $id);
        $row = $this->db->resultSet();
//        print_r($row);
//        exit();
        return $row;
    }

}