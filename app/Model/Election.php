<?php 

session_start();

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
    


}