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

    public function updateElection($data){
        // $data=[
        //     "id"=>trim($_POST['id']),
        //     "title"=>trim($_POST['title']),
        //     "org"=>trim($_POST['org']),
        //     "desc"=>trim($_POST['desc']),

        //     "esdate"=>trim($_POST['EstartDate']),
        //     "eedate"=>trim($_POST['EendDate']),
        //     "estime"=>trim($_POST['EstartTime']),
        //     "eetime"=>trim($_POST['EendTime']),

        //     "osdate"=>trim($_POST['OstartDate']),
        //     "oedate"=>trim($_POST['OendDate']),
        //     "ostime"=>trim($_POST['OstartTime']),
        //     "oetime"=>trim($_POST['OendTime']),

        //     "status"=>trim($_POST['stat']),

        //     "nomi"=>trim($_POST['nomi']),
        //     "nomidesc"=>trim($_POST['nomiDesc']),

        //     "ostat"=>trim($_POST['ostat'])
        // ];

        $this->db->query(
                "UPDATE Election SET 
                OrganizationName = :1,
                Title = :2,
                StartDate = :3,
                EndDate = :4,
                Description = :5,
                StatVisibality = :6,
                SelfNomination = :7,
                StartTime = :8,
                EndTime = :9,
                ObjectionStatus = :10,
                ObjectionStartDate = :11,
                ObjectionEndDate = :12,
                ObjectionStartTime = :13,
                ObjectionEndTime = :14,
                NominationDescription = :15,
                WHERE ElectionId = :16"
            );

        $this->db->bind(':1', $data['org']);
        $this->db->bind(':2', $data['title']);
        $this->db->bind(':3', $data['esdate']);
        $this->db->bind(':4', $data['eedate']);
        $this->db->bind(':5', $data['desc']);
        $this->db->bind(':6', $data['status']);
        $this->db->bind(':7', $data['nomi']);
        $this->db->bind(':8', $data['estime']);
        $this->db->bind(':9', $data['eetime']);
        $this->db->bind(':10', $data['ostat']);
        $this->db->bind(':11', $data['osdate']);
        $this->db->bind(':12', $data['oedate']);
        $this->db->bind(':13', $data['ostime']);
        $this->db->bind(':14', $data['oetime']);
        $this->db->bind(':15', $data['nomidesc']);
        $this->db->bind(':16', $data['id']);

        try {
            $this->db->execute();
            $id = $this->db->lastInsertId();
            return $id;
            
        } catch (Exception $e) {
            echo "Something went wrong";
            return false;
        }
    }
        
}