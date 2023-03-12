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

        public function __construct(){
            $this->postModel = $this->model('User');
            $this->electionModel = $this->model('Election');
            $this->candidateModel = $this->model('Candidate');
            $this->positionModel = $this->model('electionPositions');
            $this->partyModel = $this->model('Party');
            $this->voterModel = $this->model('Voter');
            $this->objectionModel = $this->model('Objection');
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
             $posts = $this->postModel->getPosts();
            
        }

        public function about(){
           
        }  

        public function dashboard(){
            $r_ongoing=$this->electionModel->getOngoingElections();
            $r_upcoming=$this->electionModel->getUpcomingElections();
            $r_completed=$this->electionModel->getCompletedElections();
            $this->view('Voter/viewAllElection',[
                'data1'=>$r_ongoing,
                'data2'=>$r_upcoming,
                'data3'=>$r_completed
            ]);
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
//            if(!isset($_SESSION["UserId"])){
//                redirect('View/login');
//            }else{
//                $row = $this->electionModel->getElectionsByUserId($_SESSION["UserId"]);
                $row = $this->electionModel->getElectionsByUserId('48');
                $this->view('Supervisor/ViewMyElections',$row);
            }
//        }

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

}