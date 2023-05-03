<?php 


//session_start();



class Election extends Controller{
    private $db;
    private $logModel;

    public function __construct(){
        $this->db = new Database;
        $this->logModel = $this->model('log');
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

            $logDesc = "Created election with title ".$data['title']." By ".$data['orgname'].".";
            $this->logModel->saveLog($logDesc, $data['id'], $_SESSION["UserId"]);

            redirect('Pages/wayToAddVoters/'.$data['id']);
            // $this->view('Supervisor/addVoters', $data);  
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
        $dates=date("Y-m-d");
        $times=date("H:i:s");
        $this->db->query(
            "SELECT * FROM Election WHERE ((StartDate<'".$dates."' && ((EndDate='".$dates."' && EndTime>='".$times."') || (EndDate>'".$dates."'))) ||((StartDate='".$dates."' && StartTime<='".$times."') &&(EndDate>'".$dates."' || (EndDate='".$dates."' && EndTime>'".$times."'))))"
        );
//        echo '<pre>';
//        print_r($this->db);
//        exit();
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
            "SELECT * FROM Election WHERE (StartDate='".$dates."' && StartTime>'".$times."') ||(StartDate>'".$dates."' && StartTime>='".$times."')|| (StartDate>'".$dates."' && StartTime<'".$times."') "
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
            "SELECT * FROM Election WHERE (EndDate='" . $dates . "' && EndTime<'" . $times . "') ||(EndDate<'" . $dates . "' && EndTime>='" . $times . "') || (EndDate<'" . $dates . "' && EndTime<'" . $times . "')"
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
        $this->db->query("SELECT DISTINCT ID,positionName FROM ElectionPosition WHERE ElectionID ='" .$election_Id. "'" );
        $row = $this->db->resultSet();
        return $row;
    }

    public function getCandidatesByElectionId($id)
    {
        $election_Id = $id;
        $this->db->query("SELECT * FROM Candidate WHERE electionid ='" . $election_Id . "' order by positionid");
        $row = $this->db->resultSet();
        return $row;

    }

    public function getWinnersDetails($id)
    {
        $election_Id=1281;
        $this->db->query("SELECT * FROM votes WHERE electionid ='" . $election_Id ."' order by NoOfVotes Desc" );
        $row=$this->db->resultSet();
        return $row;
    }

    public function getWinnerNames($id)
    {
        $candidate_Id=$id;
        $this->db->query("SELECT Candidate.candidateName,ElectionParty.partyName FROM Candidate where candidateId='" .$candidate_Id. "' inner join electionparty on Candidate.partyId=ElectionParty.partyId ");
        $row=$this->db->resultSet();
        print_r($row);
        exit();
        return $row;
    }


    public function updateElection($data){
              

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
                NominationDescription = :15
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
            
            return true;
            
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }



    public function getVotersByElectionID($id)
    {
        $election_Id = $id;
        $this->db->query("SELECT userId,voterId FROM Voter WHERE electionid ='" . $election_Id . "'");
        $row = $this->db->resultSet();
        return $row;
    }

    public function deleteElection($id){
        $this->db->query("DELETE FROM Election WHERE ElectionId = :id");
        $this->db->bind(':id', $id);
        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            echo $e;
        }

    }      
    public function findelectNameById($id){
        $this->db->query("SELECT * FROM election WHERE electionid=$id");
    try {
        $this->db->execute();
        return $this->db->resultSet(); // return object
    } catch (Exception $e) {
        echo "Something went wrong :".$e->getMessage();
    }

}



    public function getElectionIdByVoterId($id){
        $this->db->query("SELECT electionId FROM Voter WHERE userid = :id");
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }
}