<?php
//    session_start();
class Pages extends Controller
{
    private $postModel;
    private $electionModel;
    private $candidateModel;
    private $positionModel;
    private $partyModel;
    private $voterModel;
    private $objectionModel;
    private $encryptModel;
    private $voteModel;
    private $logModel;

    private $conferenceModel;

    private $userModel;
    private $mail;

    private $nominationModel;
    private $planModel;


    public function __construct()
    {
        $this->postModel = $this->model('User');
        $this->electionModel = $this->model('Election');
        $this->candidateModel = $this->model('Candidate');
        $this->positionModel = $this->model('electionPositions');
        $this->partyModel = $this->model('Party');
        $this->voterModel = $this->model('Voter');
        $this->objectionModel = $this->model('Objection');
        $this->voteModel = $this->model('Vote');
        $this->encryptModel = $this->model('userEncrypt');

        $this->conferenceModel = $this->model('Conference');

        $this->userModel = $this->model('User');
        $this->mail = $this->model('Email');
        $this->logModel = $this->model('log');
        $this->nominationModel = $this->model('Nomination');
        $this->planModel = $this->model('Subscription');
    }

    public function index()
    {
        if ($this->isLoggedIn()) {
            $this->view('Voter/viewAllElection');
        } else {
            $data = [
                'title' => 'Welcome',
                // 'posts' => $posts
            ];
            $this->view('index', $data);
        }
        //  $posts = $this->postModel->getPosts();

    }

    public function about()
    {
    }

    public function dashboard()
    {
        $s_ongoing_filtered = [];
        $s_upcoming_filtered = [];
        $s_completed_filtered = [];
        $v_ongoing_filtered = [];
        $v_upcoming_filtered = [];
        $v_completed_filtered = [];
        $c_ongoing_filtered = [];
        $c_upcoming_filtered = [];
        $c_completed_filtered = [];
        if ($this->isLoggedIn()) {
            $r_ongoing = $this->electionModel->getOngoingElections();
            if ($r_ongoing != null) {
                foreach ($r_ongoing as $row) {
                    if ($row->Supervisor == $_SESSION["UserId"]) {
                        $s_ongoing_filtered[] = $row;
                    } else {
                        continue;
                    }
                }

                foreach ($r_ongoing as $row) {
                    $v_row = $this->electionModel->getVotersByElectionID($row->ElectionId);
                    foreach ($v_row as $voter) {
                        if ($voter->userId == $_SESSION["UserId"]) {
                            $row = $this->electionModel->getElectionByElectionId($row->ElectionId);
                            $v_ongoing_filtered[] = $row;
                        }


                        //remove duplicate entries
                        $v_ongoing_filtered = array_unique($v_ongoing_filtered, SORT_REGULAR);

                }
//                    echo '<pre>';
//                    print_r($v_ongoing_filtered);
//                    exit;

                foreach($r_ongoing as $row){
                        $c_row=$this->electionModel->getCandidatesByElectionId($row->ElectionId);
                        foreach ($c_row as $candidate){
                            if($candidate->userId==$_SESSION["UserId"]){
                                $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
                                $c_ongoing_filtered[] = $row;
                            }
                        }
                    // Remove duplicate entries using ElectionId
                    $c_ongoing_filtered = array_unique($c_ongoing_filtered, SORT_REGULAR);
//                    echo '<pre>';
//                    print_r($c_ongoing_filtered);
//                    exit();
//                        if($c_row[0]->userId==$_SESSION["UserId"]){
//                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
//                            $c_ongoing_filtered[] = $row;
//                        }

                }


                }
            }
            $r_upcoming = $this->electionModel->getUpcomingElections();
            if ($r_upcoming != null) {
                foreach ($r_upcoming as $row) {
                    if ($row->Supervisor == $_SESSION["UserId"]) {
                        $s_upcoming_filtered[] = $row;
                    } else {
                        continue;
                    }
                }

                foreach ($r_upcoming as $row) {
                    $v_row = $this->electionModel->getVotersByElectionID($row->ElectionId);
                    foreach ($v_row as $voter) {
                        if ($voter->userId == $_SESSION["UserId"]) {
                            $row = $this->electionModel->getElectionByElectionId($row->ElectionId);
                            $v_upcoming_filtered[] = $row;
                        }

                        // Remove duplicate entries using ElectionId
                        $v_upcoming_filtered = array_unique($v_upcoming_filtered, SORT_REGULAR);

//                        if($v_row[0]->userId==$_SESSION["UserId"]){
//                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
//                            $v_upcoming_filtered[] = $row;
//                        }

                    }
                    //                        if($v_row[0]->userId==$_SESSION["UserId"]){
                    //                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
                    //                            $v_upcoming_filtered[] = $row;
                    //                        }
                }
                foreach ($r_upcoming as $row) {
                    $c_row = $this->electionModel->getCandidatesByElectionId($row->ElectionId);
                    foreach ($c_row as $candidate) {
                        if ($candidate->userId == $_SESSION["UserId"]) {
                            $row = $this->electionModel->getElectionByElectionId($row->ElectionId);
                            $c_upcoming_filtered[] = $row;
                        }

                        // Remove duplicate entries using ElectionId
                        $c_upcoming_filtered = array_unique($c_upcoming_filtered, SORT_REGULAR);
//                        if($c_row[0]->userId==$_SESSION["UserId"]){
//                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
//                            $c_upcoming_filtered[] = $row;
//                        }


                    }
                    //                        if($c_row[0]->userId==$_SESSION["UserId"]){
                    //                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
                    //                            $c_upcoming_filtered[] = $row;
                    //                        }

                }
            }
            $r_completed = $this->electionModel->getCompletedElections();
            if ($r_completed != null) {
                foreach ($r_completed as $row) {
                    if ($row->Supervisor == $_SESSION["UserId"]) {
                        $s_completed_filtered[] = $row;
                    } else {
                        continue;
                    }
                }


                foreach($r_completed as $row){
                    $v_row=$this->electionModel->getVotersByElectionID($row->ElectionId);
                    foreach ($v_row as $voter){
                            if($voter->userId==$_SESSION["UserId"]){
                                $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
                                $v_completed_filtered[] = $row;
                            }
                    }
                    // Remove duplicate entries using ElectionId
                    $v_completed_filtered = array_unique($v_completed_filtered, SORT_REGULAR);
//                        if($v_row[0]->userId==$_SESSION["UserId"]){
//                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
//                            $v_completed_filtered[] = $row;
//                        }

                }
                foreach ($r_completed as $row) {
                    $c_row = $this->electionModel->getCandidatesByElectionId($row->ElectionId);
                    foreach ($c_row as $candidate) {
                        if ($candidate->userId == $_SESSION["UserId"]) {
                            $row = $this->electionModel->getElectionByElectionId($row->ElectionId);
                            $c_completed_filtered[] = $row;
                        }
                    }

                    // Remove duplicate entries using ElectionId
                    $c_completed_filtered = array_unique($c_completed_filtered, SORT_REGULAR);
//                        if($c_row[0]->userId==$_SESSION["UserId"]){
//                            $row=$this->electionModel->getElectionByElectionId($row->ElectionId);
//                            $c_completed_filtered[] = $row;
//                        }


                }
            }

            $voters = $this->voterModel->getVotersByUserId($_SESSION["UserId"]);

            $this->view('Voter/viewAllElection', [
                'data1' => $s_ongoing_filtered,
                'data2' => $s_upcoming_filtered,
                'data3' => $s_completed_filtered,
                'data4' => $v_ongoing_filtered,
                'data5' => $v_upcoming_filtered,
                'data6' => $v_completed_filtered,
                'data7' => $c_ongoing_filtered,
                'data8' => $c_upcoming_filtered,
                'data9' => $c_completed_filtered,
                'voters' => $voters
            ]);
        } else {
            $this->view('login');
        }
    }
    //replacement for dashboard function
    public function landingPage()
    {
        $dates = date("Y-m-d");
        $times = date("H:i:s");
        $dataPre = [
            'ongoing' => [],
            'upcoming' => [],
            'completed' => []
        ];
        try {
            $row = $this->electionModel->getElectionIdByVoterId($_SESSION["UserId"]);
            echo $_SESSION["UserId"] . '<br>';
            foreach ($row as $r) {
                $eid = $r->electionId;

                $election = $this->electionModel->getElectionByElectionId($eid);

                echo $eid . '-' . $election->StartDate . '-' . $election->EndDate . '-';

                if ($election->StartDate > $dates && $election->StartTime > $times) {
                    echo 'upcoming-';
                    $dataPre['upcoming'][] = ($election);
                }
                if ($election->StartDate <= $dates && $election->StartTime <= $times && $election->EndDate > $dates) {
                    echo 'ongoing-';
                    $dataPre['ongoing'][] = ($election);
                }
                if ($election->EndDate == $dates && $election->EndTime == $times) {
                    echo 'ongoing-';
                    $dataPre['ongoing'][] = ($election);
                }
                if ($election->EndDate == $dates && $election->EndTime < $times) {
                    echo 'completed-';
                    $dataPre['completed'][] = ($election);
                }
                if ($election->EndDate < $dates && $election->EndTime < $times) {
                    echo 'completed-';
                    $dataPre['completed'][] = ($election);
                }
                echo '<br>';
            }

            $voters = $this->voterModel->getVotersByUserId($_SESSION["UserId"]);

            echo 'ongoing<br>';
            foreach ($dataPre['ongoing'] as $row) {
                echo $row->ElectionId . '<br>';
            }

            echo '<br>upcoming<br>';
            foreach ($dataPre['upcoming'] as $row) {
                echo $row->ElectionId . '<br>';
            }

            echo '<br>completed<br>';
            foreach ($dataPre['completed'] as $row) {
                echo $row->ElectionId . '<br>';
            }

            $this->view('Voter/viewAllElection', [
                'data1' => '',
                'data2' => '',
                'data3' => '',
                'data4' => $dataPre['ongoing'],
                'data5' => $dataPre['upcoming'],
                'data6' => $dataPre['completed'],
                'data7' => '',
                'data8' => '',
                'data9' => '',
                'voters' => $voters
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function register()
    {
        $data = [];
        $this->view('register', $data);
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            redirect('Pages/dashboard');
        } else {
            $data = [];
            $this->view('login', $data);
        }
    }

    //for login
    public function signing($email = '', $password = '')
    {
        if ($this->isLoggedIn()) {
            redirect('Pages/dashboard');
        } else {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $this->logged($email, $password, $this->postModel->getUsers());
            } else {
                $this->view('login');
            }
        }
    }

    public function createelection()
    {
        if (!isset($_SESSION["UserId"])) {
            redirect('View/login');
        } else {
            $this->view('Supervisor/createElection');
        }
    }

    public function wayToAddVoters($eid)
    {
        $this->View('Supervisor/addVoters', $eid);
    }

    public function wayToAddPositions($eid)
    {
        $this->view('Supervisor/addPositions', $eid);
    }

    public function wayToAddCandidates($eid)
    {
        $positionRow = $this->positionModel->getElectionPositionByElectionId($eid);
        $data = [
            'ID' => $eid,
            'positionRow' => $positionRow
        ];
        $this->view('Supervisor/addCandidates', $data);
    }

    public function fortests()
    {
        $this->view('sendEmail');
    }

    public function ViewMyElections()
    {
        if (!isset($_SESSION["UserId"])) {
            redirect('View/login');
        } else {
            $row = $this->electionModel->getElectionsByUserId($_SESSION["UserId"]);
            $this->view('Supervisor/ViewMyElections', $row);
        }
    }

    public function sortByTitle()
    {
        if (!isset($_SESSION["UserId"])) {
            redirect('View/login');
        } else {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $row = $this->electionModel->getElectionsByUserIdSorted($_SESSION["UserId"], trim($_POST['sortMethod']));
            $this->view('Supervisor/ViewMyElections', $row);
        }
    }

    public function viewMyElection($id)
    {
        if (!isset($_SESSION["UserId"])) {
            redirect('View/login');
        } else {
            $electionRow = $this->electionModel->getElectionByElectionId($id);
            if ($electionRow->Supervisor == $_SESSION["UserId"]) {
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

                $this->view('Supervisor/viewMyElection', $data);
            } else {
                echo " Forbidden Access";
            }
        }
    }

    public function subscriptionPlans()
    {
        $this->view('Supervisor/subscriptionPlans');
    }

    public function electionCandidates($id)
    {
        if (!isset($_SESSION["UserId"])) {
            redirect('View/login');
        } else {
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

            $this->view('Supervisor/electionCandidates', $data);
            //                }else{
            //                    echo "Forbidden Access";
            //                }
        }
    }

    public function electionVoters($id)
    {
        if (!$this->isLoggedIn()) {
            redirect('View/login');
        } else {
            $electionRow = $this->electionModel->getElectionByElectionId($id);
            if ($electionRow->Supervisor == $_SESSION["UserId"]) {


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

                $this->view('Supervisor/electionVoters', $data);
            } else {
                echo "<h1 class='text-danger'>Forbidden Access</h1>";
            }
        }
    }

    public function electionNominations($id)
    {
        if (!isset($_SESSION["UserId"])) {
            redirect('View/login');
        } else {
            $electionRow = $this->electionModel->getElectionByElectionId($id);
            if ($electionRow->Supervisor == $_SESSION["UserId"]) {
                $nominations = $this->nominationModel->getNominationsByElectionId($id);
                $positions = $this->positionModel->getElectionPositionByElectionId($id);
                $parties = $this->partyModel->getPartiesByElectionId($id);
                $data=[
                    'election' => $electionRow,
                    'nominations' => $nominations,
                    'positions' => $positions,
                    'parties' => $parties,
                ];
                $this->view('Supervisor/electionNominations', $data);
            } else {
                $this->view('Supervisor/forbiddenPage');
            }
        }
    }

    public function viewObjections($id)
    {
        $electionRow = $this->electionModel->getElectionByElectionId($id);
        if ($electionRow->Supervisor == $_SESSION["UserId"]) {
            $objectionRow = $this->objectionModel->getObjectionsByElectionId($id);
            $CandidateRow = $this->candidateModel->getCandidatesByElectionId($id);
            $voterRow = $this->voterModel->getRegVotersByElectionId($id);
            $users = $this->postModel->getUsers();
            $positions = $this->positionModel->getElectionPositionByElectionId($id);

            $data = [
                'ID' => $id,
                'objections' => $objectionRow,
                'candidates' => $CandidateRow,
                'voters' => $voterRow,
                'users' => $users,
                'positions' => $positions
            ];

            $this->view('Supervisor/viewObjections', $data);
        } else {
            $this->view('Supervisor/forbiddenPage');
        }
    }

    public function electionParties($id)
    {
        if (!isset($_SESSION["UserId"])) {
            redirect('View/login');
        } else {
            $electionRow = $this->electionModel->getElectionByElectionId($id);
            if ($electionRow->Supervisor == $_SESSION["UserId"]) {
                $data = [];

                $partyRow = $this->partyModel->getPartiesByElectionId($id);
                $candidateRow = $this->candidateModel->getCandidatesByElectionId($id);

                $data['ID'] = $id;
                $data['partyRow'] = $partyRow;
                $data['candidateRow'] = $candidateRow;

                $this->view('Supervisor/electionParties', $data);
            } else {
                echo "Forbidden Access";
            }
        }
    }

    public function aboutUs()
    {
        $this->view('about_us');
    }

    public function contactUs()
    {
        $this->view('contact_us');
    }

    public function pricing()
    {
        $this->view('pricing');
    }


    public function gohome()
    {
        $this->view('home');
    }

    public function home()
    {

        $this->view('home');
    }


    public function targetUsers()
    {
        $this->view('target_users');
    }

    public function Sysmanager()
    {
        $this->view('Sys_manager/Sysmanager_login');
    }


    public function planpricing(){
        if (!isset($_SESSION["UserId"])) {
            redirect('login');
        } else {
            $data = $this->postModel->pricingPlan();
            
            $this->view('userSubscribe', $data);
        }
    }

    public function payment(){
        if (!isset($_SESSION["UserId"])) {
            redirect('View/login');
        }else{
            $this->view('userPayment');
        }
    }


    public function viewOngoingElection($electionId)
    {
        if ($this->isLoggedIn()) {
            $data1 = $this->electionModel->getElectionByElectionId($electionId);
            $data2 = $this->electionModel->getPositionsByElectionId($electionId);
            $this->view(
                'Supervisor/viewOngoingElection',
                [
                    'election' => $data1,
                    'positions' => $data2
                ]
            );
        }
    }


    public function viewCompletedElection($electionId)
    {
        if ($this->isLoggedIn()) {
            $data1 = $this->electionModel->getElectionByElectionId($electionId);
            if ($data1->Supervisor == $_SESSION["UserId"]) {
                $data2 = $this->electionModel->getPositionsByElectionId($electionId);
                $voters = $this->voterModel->getVotersByElectionId($electionId);
                $candidates = $this->candidateModel->getCandidatesByElectionId($electionId);
                $parties = $this->partyModel->getPartiesByElectionId($electionId);
                $supervisor = $this->userModel->getUserById($data1->Supervisor);
                $votes = $this->calculateVotes($electionId);

                $this->view(
                    'Supervisor/electionSummary',
                    [
                        'election' => $data1,
                        'positions' => $data2,
                        'voters' => $voters,
                        'candidates' => $candidates,
                        'parties' => $parties,
                        'votes' => $votes,
                        'supervisor' => $supervisor
                    ]
                );
            } else {
                $this->view('Supervisor/forbiddenPage');
            }
        } else {
            redirect('View/login');
        }
    }

    public function viewAllObjections()
    {
        echo "view all objections";
        //       $this->view('Supervisor/viewAllObjections');
    }

    public function viewAllConferences()
    {
        if ($this->isLoggedIn()) {
            $data1 = $this->conferenceModel->getConferencesByUserID($_SESSION["UserId"]);
            $data2 = $this->conferenceModel->getNotSupervisingConferences($_SESSION['UserId']);
            $data4 = [];
            $data5 = [];
            foreach ($data2 as $nSConference) {
                $electionId = $nSConference->ElectionID;
                $candiList = $this->electionModel->getCandidatesByElectionId($electionId);
                foreach ($candiList as $candi) {
                    if ($candi->userId == $_SESSION['UserId']) {
                        $data4[] = $this->conferenceModel->getConferenceByConferenceID($nSConference->conferenceID);
                    }
                }
            }


            foreach ($data2 as $nSConference){
                $electionId=$nSConference->ElectionID;
                $votList=$this->voterModel->getVotersByElectionId($electionId);
                foreach ($votList as $vot){
                    if($vot->userId==$_SESSION['UserId']){
                        $data5[]=$this->conferenceModel->getConferenceByConferenceID($nSConference->conferenceID);
                    }
                }
            }

//            $data4=$this->conferenceModel->getCandidatesByElectionID($_SESSION["UserId"]);
//            $data5=$this->conferenceModel->getVotersByElectionID($_SESSION["UserId"]);
            $data=$this->candidateModel->getCandidateByUserId();
//            $data2=[];
//            foreach ($data as $candidate){
//                $row=$this->conferenceModel->getConferencesByCandidateId($candidate->candidateId);
//                $data2[]=$row;
//
//            }
//            var_dump($data);
//            exit();

            //get current time
            //            $now = new DateTime();
            //            //get ongoing conferences
            //            $data1 = array();
            //            foreach ($data as $row) {
            //                $t=new DateTime($row->DateAndTime);
            ////                $interval = $now->diff($t);
            ////                var_dump($interval);
            ////                exit();
            //                //                echo $interval->format('%H:%I:%S');
            ////                exit();
            //                $now->setTimestamp($now->getTimestamp()+19800);
            //                if ($now->getTimestamp()<$t->getTimestamp()) {
            //                    array_push($data1, $row);
            //                }
            //            }
            //get upcoming conferences
            //            $data2 = array();
            //            foreach ($data as $row) {
            //                $t=new DateTime($row->DateAndTime);
            ////                $interval = $now->diff($t);
            ////                echo $interval->format('%R%a');
            ////                exit();
            //                if ($now->getTimestamp()>$t->getTimestamp()) {
            //                    array_push($data2, $row);
            //                }
            //            }
            $data3 = $this->electionModel->getElectionsByUserId($_SESSION["UserId"]);
            $data6 = $this->electionModel->getElections();
            $this->view(
                'Supervisor/viewAllConference',
                [
                    'supervising_conferences' => $data1,
                    'candidating_conferences' => $data4,
                    'voting_conferences' => $data5,
                    //                    'ongoing_conferences'=>$data1,
                    //                    'upcoming_conferences'=>$data2,
                    'elections' => $data3,
                    'all_elections' => $data6
                ]
            );
        } else {

            redirect('View/login');
        }
    }


    public function addConference($electionID)
    {

        //        $electionID=1281;
        if ($this->isLoggedIn()) {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $candidates = false;
                $voters = false;
                if (isset($_POST['candidate'])) {
                    $candidates = true;
                }
                if (isset($_POST['voter'])) {
                    $voters = true;
                }
                //                $candidates = $_POST['candidate'];
                //                if (empty($candidates)) {
                //                    $data['candidateError'] = "Please select at least one candidate";
                //                }
                $data = [
                    'topic' => trim($_POST['conferenceName']),
                    'date' => trim($_POST['date']),
                    'time' => trim($_POST['time']),
                    'supervisorId' => $_SESSION["UserId"],
                    'electionId' => $electionID,
                    'candidates' => $candidates,
                    'voters' => $voters
                ];
                $data['start_date'] = $data['date'] . " " . $data['time'];
                unset($data['date']);
                unset($data['time']);
                //                Create a random password with 10 characters
                $data['password'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                if (isset($_POST['duration']) && $_POST['duration'] != "") {
                    $data['duration'] = $_POST['duration'];
                } else {
                    $data['duration'] = 30;
                }
                if (empty($data['topic'])) {
                    $data['conferenceNameError'] = "Please enter conference name";
                }
                if (empty($_POST['date'])) {
                    $data['dateAndTimeError'] = "Please enter date and time";
                }
                if (empty($data['conferenceNameError']) && empty($data['candidateError']) && empty($data['dateAndTimeError'])) {
                    $data['conferenceID'] = uniqid('conf_');
                    if ($this->conferenceModel->addConference($data)) {
                        $candidatesList = [];
                        $votersList = [];
                        $candidatesList[] = $this->candidateModel->getCandidatesByElectionId($electionID);
                        $votersList[] = $this->electionModel->getVotersByElectionID($electionID);
                        foreach ($candidatesList[0] as $candidate) {
                            $this->candidateModel->sendEMailCandidates($candidate->candidateId, $data);
                        }
                        foreach ($votersList[0] as $voter) {
                            $this->voterModel->sendEMailVoters($voter->voterId, $data);
                        }

                        redirect('Pages/addConference/' . $electionID . '?success=1');
                    } else {

                        die("Something went wrong");
                    }
                } else {
                    $this->view('Supervisor/scheduleConference', $data);
                }
            }
            $candidates = $this->candidateModel->getCandidatesByElectionId($electionID);
            $data1 = $this->conferenceModel->getConferencesByUserIDAndElectionID($_SESSION["UserId"], $electionID);
            $this->view(
                'Supervisor/scheduleConference',

                [
                    'electionID' => $electionID,
                    'candidates' => $candidates,
                    'supervisingConferences' => $data1
                ]
            );
        } else {
            redirect('View/login');
        }
    }
    public function castVotePrologue()
    {
        if ($this->isLoggedIn()) {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $eid = $_POST['eid'];
            $otp = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

            $vEmail = $this->userModel->getUserById($_SESSION['UserId']);
            $electionRow = $this->electionModel->getElectionByElectionId($eid);

            $mailData = [
                'email' => $vEmail->Email,
                'subject' => "OTP for voting",
                'body' => 'Your one time password for the ' . $electionRow->Title . " election is " . $otp . ". Please do not share this with anyone.",
            ];

            $otp = password_hash($otp, PASSWORD_DEFAULT);

            $data = [
                'eid' => $eid,
                'otp' => $otp,
                'uid' => $_SESSION['UserId'],
                'email' => $vEmail->Email,
            ];

            $_SESSION['email'] = $data['email'];
            if ($this->voterModel->updateVoterOtp($data)) {
                if ($this->mail->sendEmail($mailData)) {
                    redirect('Votings/otpVerifyPage/' . $eid);
                } else {
                    die("Error sending Email with OTP");
                }
            }
        } else {

            redirect('View/login');
        }
    }


    public function encrypt($data, $key, $iv)
    {
        $encryptedData = openssl_encrypt($data, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        $encryptedData = base64_encode($encryptedData);
        return $encryptedData;
    }

    public function decrypt($data, $key, $iv)
    {
        $decryptedData = base64_decode($data);
        $decryptedData = openssl_decrypt($decryptedData, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }


    //utility function
    //will return an associative array with candidateId as key and count of votes as value
    public function calculateVotes($eid)
    {
        $candidates = array();
        $voters = $this->voterModel->getVotersByElectionId($eid);
        $candidateRows = $this->candidateModel->getCandidatesByElectionId($eid);
        foreach ($candidateRows as $candidateRow) {
            $candidates[$candidateRow->candidateId] = 0;
        }
        foreach ($voters as $voter) {
            // echo $voter->voterId."<br>";
            $encryption = $this->encryptModel->getKeyAndIv($voter->voterId);
            $votes = $this->voteModel->retrieveVotes($voter->voterId);
            foreach ($votes as $vote) {
                $candidate = $this->decrypt($vote->candidate, $encryption->Key, $encryption->Iv);
                // echo $candidate."<br>";
                if ($this->verifyCandidate($eid, $candidate)) {
                    $candidates[$candidate] += $voter->value;
                }
            }
        }
        // // print candidates

        // $keys = array_keys($candidates);

        // echo "Candidates : Votes <br>";
        // foreach($keys as $key){
        //     echo $key . " : " . $candidates[$key] . "<br>";
        // }

        return $candidates;
    }

    public function verifyCandidate($eid, $cid)
    {
        $candidate = $this->candidateModel->getCandidateByCandidateId($cid);
        $election = $this->electionModel->getElectionByElectionId($eid);
        if ($election->ElectionId == $candidate->electionid) {
            return true;
        } else {
            return false;
        }
    }

    public function viewCandidate($cid)
    {
        $candidate = $this->candidateModel->getCandidateByCandidateId($cid);
        $election = $this->electionModel->getElectionByElectionId($candidate->electionid);
        $party = $this->partyModel->getPartyById($candidate->partyId);
        $positions = $this->positionModel->getElectionPositionByElectionId($candidate->electionid);
        $duplicates = $this->candidateModel->getCandidatesByEmailAndElectionId($candidate->candidateEmail, $candidate->electionid);

        if ($election->Supervisor == $_SESSION['UserId']) {
            $data = [
                'election' => $election,
                'candidate' => $candidate,
                'party' => $party,
                'positions' => $positions,
                'duplicates' => $duplicates
            ];
            $this->view('Supervisor/inspectCandidate', $data);
        } else {
            $this->view('Supervisor/forbiddenPage');
        }
    }

    //services page
    public function services()
    {
        $this->view('services');
    }

    //    profile viewing
    public function editProfile()
    {
        if ($this->isLoggedIn()) {
            $userID = $_SESSION['UserId'];
            //            var_dump($_SESSION);
            ////                var_dump($_FILES);
            //            exit();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_FILES['profilePhoto'])) {
                    $image = $_FILES['profilePhoto']['name'];
                }
                $data = [
                    'id' => $_SESSION['UserId'],
                    //                    'profile_pic'=>$_FILES['profilePhoto'],
                    'fname' => trim($_POST['fname']),
                    'lname' => trim($_POST['lname']),
                    'email' => trim($_POST['email']),
                    'old_password' => trim($_POST['old_password']),
                    'new_password' => trim($_POST['new_password']),
                    'confirmPassword' => trim($_POST['confirmed_password']),
                    'old_passwordError' => '',
                    'new_passwordError' => '',
                    'confirmPasswordError' => ''
                ];
                //                else{
                //                    if($this->userModel->findUserByEmail($data['email'])){
                //                        $data['emailError']="Email already taken";
                //                    }
                //                }
                //                if(empty($data['old_password'])){
                //                    $data['old_passwordError']="Please enter old password";
                //                }
                if (!empty($data['fname']) && !empty($data['lname']) && !empty($data['email']) && empty($data['old_password']) && !empty($data['new_password'])) {
                    $data['old_passwordError'] = "Please enter old password";
                }
                if (!empty($data['fname']) && !empty($data['lname']) && !empty($data['email']) && !empty($data['old_password']) && !empty($data['new_password']) && empty($data['confirmPassword'])) {
                    $data['confirmPasswordError'] = "Please enter confirm password";
                }
                $data1 = $this->userModel->getUserById($_SESSION['UserId']);
                if (empty($data['old_passwordError'])) {
                    if (empty($data['old_password'])) {
                        $data = [
                            'id' => $_SESSION['UserId'],
                            'fname' => trim($_POST['fname']),
                            'lname' => trim($_POST['lname']),
                            'email' => trim($_POST['email']),
                            'old_password' => $data1->Password,
                            'new_password' => $data1->Password,
                            'confirmPassword' => $data1->Password,
                            'old_passwordError' => '',
                            'new_passwordError' => '',
                            'confirmPasswordError' => ''
                        ];
                        $this->userModel->updateProfile($data);
                        redirect('pages/dashboard');
                    } else {
                        if ((password_verify($data['old_password'], $data1->Password))) {
                            if ($data['new_password'] === $data['confirmPassword']) {
                                $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
                                //                            var_dump('hello');
                                //                            exit();
                                $this->userModel->updateProfile($data);
                                redirect('pages/dashboard');
                            } else {
                                $data['confirmPasswordError'] = "Password does not match";
                            }
                        } else {
                            $data['old_passwordError'] = "Password does not match";
                        }
                    }
                    $_SESSION['fname'] = $data['fname'];
                    $_SESSION['lname'] = $data['lname'];
                    $_SESSION['email'] = $data['email'];
                }
                //                else{
                //                    $this->view('editProfile',$data);
                //                }
                $this->view('editProfile', $data);
            } else {
                $this->view('editProfile');
            }
        } else {
            redirect('View/login');
        }
    }

    public function uploadProfileImage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_SESSION['UserId'],
                'profile_pic' => $_FILES['profile_pic']
            ];
            $this->userModel->uploadProfileImage($data);
            echo json_encode(['status' => true, 'message' => 'Profile picture uploaded successfully']);
        }
    }

    public function viewLog($id)
    {
        if (!$this->isLoggedIn()) {
            redirect('View/login');
        } else {
            $electionRow = $this->electionModel->getElectionByElectionId($id);
            if ($electionRow->Supervisor == $_SESSION['UserId']) {
                $data = [
                    'electionRow' => $electionRow,
                    'logs' => $this->logModel->getLogsByElectionId($id)
                ];
                $this->view('Supervisor/electionLog', $data);
            } else {
                $this->view('Supervisor/forbiddenPage');
            }
        }
    }

    public function electionToVoter($eid)
    {
        if (!$this->isLoggedIn()) {
            redirect('View/login');
        } else {
            $electionRow = $this->electionModel->getElectionByElectionId($eid);
            $voters = $this->voterModel->getVotersByElectionId($eid);
            $candidates = $this->candidateModel->getCandidatesByElectionId($eid);
            $positions = $this->positionModel->getElectionPositionByElectionId($eid);

            $data =[
                'election' => $electionRow,
                'voters' => $voters,
                'candidates' => $candidates,
                'positions' => $positions
            ];

            $check = 0;
            foreach ($voters as $voter) {
                if ($voter->userId != null and $voter->userId == $_SESSION['UserId']) {
                    $check = 1;
                    break;
                }
            }
            if($check == 1){
                $this->view('Voter/electionForVoter',$data);
            }else{
                $this->view('Supervisor/forbiddenPage');
            }
        }
    }

    public function subsPlans(){
        if (!$this->isLoggedIn()) {
            redirect('View/login');
        } else {
            $data = [
                'plans' => $this->planModel->getSubscriptionPlans()
            ];
            $this->view('Supervisor/subscriptionPlans',$data);
        }
    }
}

