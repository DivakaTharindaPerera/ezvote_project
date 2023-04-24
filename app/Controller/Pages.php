<?php
//    session_start();
    class Pages extends Controller{
        private $postModel;
        private $electionModel;
        private $candidateModel;
        private $positionModel;
        private $partyModel;
        private $voterModel;
        private $objectionModel;

        private $conferenceModel;

        private $userModel;
        private $mail;


        public function __construct(){
            $this->postModel = $this->model('User');
            $this->electionModel = $this->model('Election');
            $this->candidateModel = $this->model('Candidate');
            $this->positionModel = $this->model('electionPositions');
            $this->partyModel = $this->model('Party');
            $this->voterModel = $this->model('Voter');
            $this->objectionModel = $this->model('Objection');

            $this->conferenceModel = $this->model('Conference');

            $this->userModel = $this->model('User');
            $this->mail = $this->model('Email');

        }

        public function index(){
            if($this->isLoggedIn()){
                $this->view('Voter/viewAllElection');

            }else{
                $data = [
                    'title' => 'Welcome',
                    // 'posts' => $posts
                ];
                $this->view('index', $data);
            }
            //  $posts = $this->postModel->getPosts();
            
        }

        public function about(){
           
        }  

        public function dashboard(){
            $s_ongoing_filtered=[];
            $s_upcoming_filtered=[];
            $s_completed_filtered=[];
            $v_ongoing_filtered=[];
            $v_upcoming_filtered=[];
            $v_completed_filtered=[];
            $c_ongoing_filtered=[];
            $c_upcoming_filtered=[];
            $c_completed_filtered=[];
            if($this->isLoggedIn()) {
                $r_ongoing=$this->electionModel->getOngoingElections();
                if($r_ongoing!=null) {
                    foreach ($r_ongoing as $row) {
                        if ($row->Supervisor == $_SESSION["UserId"]) {
                            $s_ongoing_filtered[] = $row;
                        } else {
                            continue;
                        }
                    }
                    foreach($r_ongoing as $row){
                        $v_row=$this->electionModel->getVotersByElectionID($row->ElectionId);
                        if($v_row[0]->userId==$_SESSION["UserId"]){
                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
                            $v_ongoing_filtered[] = $row;
                        }
                    }
                    foreach($r_ongoing as $row){
                        $c_row=$this->electionModel->getCandidatesByElectionId($row->ElectionId);
                        if($c_row[0]->userId==$_SESSION["UserId"]){
                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
                            $c_ongoing_filtered[] = $row;
                        }
                    }
                }
                $r_upcoming=$this->electionModel->getUpcomingElections();
                if($r_upcoming!=null){
                    foreach ($r_upcoming as $row){
                        if($row->Supervisor==$_SESSION["UserId"]){
                            $s_upcoming_filtered[] = $row;
                        }
                        else{
                            continue;
                        }
                    }
                    foreach($r_upcoming as $row){
                        $v_row=$this->electionModel->getVotersByElectionID($row->ElectionId);
                        if($v_row[0]->userId==$_SESSION["UserId"]){
                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
                            $v_upcoming_filtered[] = $row;
                        }
                    }
                    foreach($r_upcoming as $row){
                        $c_row=$this->electionModel->getCandidatesByElectionId($row->ElectionId);
                        if($c_row[0]->userId==$_SESSION["UserId"]){
                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
                            $c_upcoming_filtered[] = $row;
                        }
                    }
                }
                $r_completed=$this->electionModel->getCompletedElections();
                if($r_completed!=null){
                    foreach ($r_completed as $row){
                        if($row->Supervisor==$_SESSION["UserId"]){
                            $s_completed_filtered[] = $row;
                        }
                        else{
                            continue;
                        }
                    }
                    foreach($r_completed as $row){
                        $v_row=$this->electionModel->getVotersByElectionID($row->ElectionId);
                        if($v_row[0]->userId==$_SESSION["UserId"]){
                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
                            $v_completed_filtered[] = $row;
                        }
                    }
                    foreach($r_completed as $row){
                        $c_row=$this->electionModel->getCandidatesByElectionId($row->ElectionId);
                        if($c_row[0]->userId==$_SESSION["UserId"]){
                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
                            $c_completed_filtered[] = $row;
                        }
                    }
                }
                $voters = $this->voterModel->getVotersByUserId($_SESSION["UserId"]);

                $this->view('Voter/viewAllElection',[
                    'data1'=>$s_ongoing_filtered,
                    'data2'=>$s_upcoming_filtered,
                    'data3'=>$s_completed_filtered,
                    'data4'=>$v_ongoing_filtered,
                    'data5'=>$v_upcoming_filtered,
                    'data6'=>$v_completed_filtered,
                    'data7'=>$c_ongoing_filtered,
                    'data8'=>$c_upcoming_filtered,
                    'data9'=>$c_completed_filtered,
                    'voters'=>$voters
                ]);
            }
            else {
                $this->view('login');
            }

        }

        public function register(){
            $data =[];
            $this->view('register', $data);
        }

        public function login(){
            if($this->isLoggedIn()){
                $this->view('Voter/viewAllElection');
            }else{
                $data =[];
                $this->view('login', $data);
            }
        }

        //for login
        public function signing($email = '', $password = ''){
            if($this->isLoggedIn()){
                $this->view('Voter/viewAllElection');
            }else{
                if($_SERVER['REQUEST_METHOD'] === "POST"){
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $this->logged($email, $password, $this->postModel->getUsers());
                }else{
                    $this->view('login');
                }
            }
        }

        public function createelection(){
            if(!isset($_SESSION["UserId"])){
                redirect('View/login');
            }else{
                $this->view('Supervisor/createElection');
            }
        }

        public function wayToAddVoters($eid){
            $this->View('Supervisor/addVoters',$eid);
        }

        public function wayToAddPositions($eid){
            $this->view('Supervisor/addPositions', $eid);
        }

        public function wayToAddCandidates($eid){
            $positionRow = $this->positionModel->getElectionPositionByElectionId($eid);
            $data = [
                'ID' => $eid,
                'positionRow' => $positionRow
            ];
            $this->view('Supervisor/addCandidates', $data);
        }

        public function fortests(){
            $this->view('sendEmail');
        }

        public function ViewMyElections(){
            if(!isset($_SESSION["UserId"])){
                redirect('View/login');
            }else{
                $row = $this->electionModel->getElectionsByUserId($_SESSION["UserId"]);
                $this->view('Supervisor/ViewMyElections',$row);
            }
        }

        public function sortByTitle(){
            if(!isset($_SESSION["UserId"])){
                redirect('View/login');
            }else{
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $row = $this->electionModel->getElectionsByUserIdSorted($_SESSION["UserId"],trim($_POST['sortMethod']));               
                $this->view('Supervisor/ViewMyElections',$row);
            }
        }

        public function viewMyElection($id){
           if(!isset($_SESSION["UserId"])){
               redirect('View/login');
           }else{
                $electionRow = $this->electionModel->getElectionByElectionId($id);
               if($electionRow->Supervisor == $_SESSION["UserId"]){
                    $data = [
                        "ID" => $id,
                    ];
                    
                    $candidateRow = $this->candidateModel->getCandidatesByElectionId($id);
                    $regVoterRow = $this->voterModel->getRegVotersByElectionId($id);
                    $unregVoterRow = $this->voterModel->getUnregVotersByElectionId($id);
                    $positionRow = $this->positionModel->getElectionPositionByElectionId($id);
                    $partyRow = $this->partyModel->getPartiesByElectionId($id);
                    
                    $data['electionRow'] = $electionRow;
                    $data['candidateRow'] = $candidateRow;
                    $data['regVoterRow'] = $regVoterRow;
                    $data['unregVoterRow'] = $unregVoterRow;
                    $data['positionRow'] = $positionRow;
                    $data['partyRow'] = $partyRow;
                    
                    $this->view('Supervisor/viewMyElection',$data);
               }else{
                   echo " Forbidden Access";
               }
           }
        }

        public function subscriptionPlans(){
            $this->view('Supervisor/subscriptionPlans');
        }

        public function electionCandidates($id){
            if(!isset($_SESSION["UserId"])){
                redirect('View/login');
            }else{
                $electionRow = $this->electionModel->getElectionByElectionId($id);
//                if($electionRow->Supervisor == $_SESSION["UserId"]){
                    $data = [];

                    $candidateRow = $this->candidateModel->getCandidatesByElectionId($id);
                    $positionRow = $this->positionModel->getElectionPositionByElectionId($id);
                    $partyRow = $this->partyModel->getPartiesByElectionId($id);

                    $data['ID'] = $id;
                    $data['electionRow'] = $electionRow;
                    $data['candidateRow'] = $candidateRow;
                    $data['positionRow'] = $positionRow;
                    $data['partyRow'] = $partyRow;
                    
                    $this->view('Supervisor/electionCandidates',$data);
//                }else{
//                    echo "Forbidden Access";
//                }
            }
        }

        public function electionVoters($id){
            if(!$this->isLoggedIn()){
                redirect('View/login');
            }else{
                $electionRow = $this->electionModel->getElectionByElectionId($id);
                if($electionRow->Supervisor == $_SESSION["UserId"]){
                    

                    $regVoterRow = $this->voterModel->getRegVotersByElectionId($id);
                    $unregVoterRow = $this->voterModel->getUnregVotersByElectionId($id);
                    $users = $this->postModel->getUsers();

                    $data = [
                        "ID" => $id,
                        "electionRow" => $electionRow,
                        "regVoterRow" => $regVoterRow,
                        "unregVoterRow" => $unregVoterRow,
                        "users" => $users,
                    ];

                    $this->view('Supervisor/electionVoters',$data);
                }else{
                    echo "<h1 class='text-danger'>Forbidden Access</h1>";
                }
            }
        }

        public function electionNominations($id){
            if(!isset($_SESSION["UserId"])){
                redirect('View/login');
            }else{
                $electionRow = $this->electionModel->getElectionByElectionId($id);
                if($electionRow->Supervisor == $_SESSION["UserId"]){
                    $data = [];

                    
                }else{
                    echo "Forbidden Access";
                }
            }
        }

    public function viewObjections($id){
            echo $id;
            exit();
        $objectionRow = $this->objectionModel->getObjectionsByElectionId($id);
        $CandidateRow = $this->candidateModel->getCandidatesByElectionId($id);
        $voterRow = $this->voterModel->getRegVotersByElectionId($id);
        $users = $this->postModel->getUsers();

        $data = [
            'ID' => $id,
            'objectionRow' => $objectionRow,
            'candidateRow' => $CandidateRow,
            'voterRow' => $voterRow,
            'users' => $users,
        ];

        $this->view('Supervisor/viewObjections',$data);
    }

    public function electionParties($id){
        if(!isset($_SESSION["UserId"])){
            redirect('View/login');
        }else{
            $electionRow = $this->electionModel->getElectionByElectionId($id);
            if($electionRow->Supervisor == $_SESSION["UserId"]){
                $data = [];

                $partyRow = $this->partyModel->getPartiesByElectionId($id);
                $candidateRow = $this->candidateModel->getCandidatesByElectionId($id);

                $data['ID'] = $id;
                $data['partyRow'] = $partyRow;
                $data['candidateRow'] = $candidateRow;

                $this->view('Supervisor/electionParties',$data);
            }else{
                echo "Forbidden Access";
            }
        }
    }

    public function aboutUs(){
        $this->view('about_us');
    }

    public function contactUs(){
        $this->view('contact_us');
    }

    public function pricing(){
        $this->view('pricing');
    }


    public function gohome(){
        $this->view('home');
    }

    public function home(){

        $this->view('home');
    }


    public function targetUsers(){
        $this->view('target_users');
    
    }
    
    public function Sysmanager(){
        $this->view('Sys_manager/Sysmanager_login');
    }

    public function viewOngoingElection($electionId)
    {
        if($this->isLoggedIn()){
            $data1=$this->electionModel->getElectionByElectionId($electionId);
            $data2=$this->electionModel->getPositionsByElectionId($electionId);
            $this->view('Supervisor/viewOngoingElection',
            [
                'election'=>$data1,
                'positions'=>$data2
            ]);
        }
    }


    public function viewCompletedElection($electionId)
    {
        if($this->isLoggedIn()){
            $data1=$this->electionModel->getElectionByElectionId($electionId);
            $data2=$this->electionModel->getPositionsByElectionId($electionId);
            $this->view('Supervisor/electionSummary',
                [
                    'election'=>$data1,
                    'positions'=>$data2
                ]);
        }
    }

    public function viewAllObjections()
    {
        echo "view all objections";
//       $this->view('Supervisor/viewAllObjections');
    }

    public function viewAllConferences()
    {
        if($this->isLoggedIn()){

            $data=$this->conferenceModel->getConferencesByUserID($_SESSION["UserId"]);
            //get current time
            $now = new DateTime();
            //get ongoing conferences
            $data1=array();
            foreach ($data as $row){
                $interval = $now->diff(new DateTime($row->DateAndTime));
//                echo $interval->format('%H:%I:%S');
//                exit();
                if($interval->format('%H:%I:%S')>0){
                    array_push($data1,$row);
                }
            }
            //get upcoming conferences
            $data2=array();
            foreach ($data as $row){
                $interval = $now->diff(new DateTime($row->DateAndTime));
//                echo $interval->format('%R%a');
//                exit();
                if($interval->format('%H:%I:%S')<=0){
                    array_push($data2,$row);
                }
            }
            $this->view('Supervisor/viewAllConference',
                [
                    'ongoing_conferences'=>$data1,
                    'upcoming_conferences'=>$data2
                ]);
        }
        else{
            redirect('View/login');
        }
    }

    public function addConference($electionID)
    {
        if($this->isLoggedIn()){
            if($_SERVER['REQUEST_METHOD']==="POST"){
                $candidates = $_POST['candidate'];
                if (empty($candidates)) {
                    $data['candidateError'] = "Please select at least one candidate";
                }
                $data=[
                    'topic'=>trim($_POST['conferenceName']),
                    'date'=>trim($_POST['date']),
                    'time'=>trim($_POST['time']),
                    'supervisorId'=>$_SESSION["UserId"],
                    'electionId'=>$electionID
                ];
                $data['start_date']=$data['date']." ".$data['time'];
                unset($data['date']);
                unset($data['time']);
//                Create a random password with 10 characters
                $data['password']=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                if (isset($_POST['duration']) && $_POST['duration'] != "") {
                    $data['duration'] = $_POST['duration'];
                }else{
                    $data['duration'] = 30;
                }
                if(empty($data['topic'])){
                    $data['conferenceNameError']="Please enter conference name";
                }
                if(empty($_POST['date'])){
                    $data['dateAndTimeError']="Please enter date and time";
                }
                if(empty($data['conferenceNameError']) && empty($data['candidateError']) && empty($data['dateAndTimeError'])){
                    $data['conferenceID']=uniqid('conf_');
                    if($this->conferenceModel->addConference($data,$candidates)){
                        $this->conferenceModel->AddCandidateToConference($data['conferenceID'],$candidates);
//                        exit();
                        redirect('Supervisor/viewAllConferences');
                    }
                    else{
                        die("Something went wrong");
                    }
                }
                else{
                    $this->view('Supervisor/scheduleConference',$data);
                }
            }
            $candidates=$this->candidateModel->getCandidatesByElectionId($electionID);
            $this->view('Supervisor/scheduleConference',
                [
                    'electionID'=>$electionID,
                    'candidates'=>$candidates
                ]);
        }
        else{
=======
    public function castVotePrologue(){
        if($this->isLoggedIn()){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $eid = $_POST['eid'];
            $otp = substr(number_format(time() * rand() , 0, '', ''), 0, 6);

            $vEmail = $this->userModel->getUserById($_SESSION['UserId']);
            $electionRow = $this->electionModel->getElectionByElectionId($eid);

            $mailData = [
                'email' => $vEmail->Email,
                'subject' => "OTP for voting",
                'body' => 'Your one time password for the '.$electionRow->Title." election is ".$otp.". Please do not share this with anyone.",
            ];

            $otp = password_hash($otp, PASSWORD_DEFAULT);

            $data = [
                'eid' => $eid,
                'otp' => $otp,
                'uid' => $_SESSION['UserId'],
                'email' => $vEmail->Email,
            ];

            $_SESSION['email'] = $data['email'];
            if($this->voterModel->updateVoterOtp($data)){
                if($this->mail->sendEmail($mailData)){
                    redirect('Votings/otpVerifyPage/'.$eid);
                }else{
                    die("Error sending Email with OTP");
                }
            }
        }else{

            redirect('View/login');
        }
    }

    public function services()
    {
        $this->view('services');
    }

}