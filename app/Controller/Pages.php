<?php
    session_start();
    class Pages extends Controller{
        private $postModel;
        private $electionModel;
        private $candidateModel;
        private $positionModel;
        private $partyModel;
        private $voterModel;

        public function __construct(){
            $this->postModel = $this->model('User');
            $this->electionModel = $this->model('Election');
            $this->candidateModel = $this->model('Candidate');
            $this->positionModel = $this->model('electionPositions');
            $this->partyModel = $this->model('Party');
            $this->voterModel = $this->model('Voter');
        }

        public function index(){
            if($this->isLoggedIn()){
                $this->view('dashboard');
            }else{
                $data = [
                    'title' => 'Welcome',
                    // 'posts' => $posts
                ];
                $this->view('index', $data);
            }
            // $posts = $this->postModel->getPosts();
            
        }

        public function about(){
           
        }  
        
        public function register(){
            $data =[];
            $this->view('register', $data);
        }

        
        
        public function login(){
            if($this->isLoggedIn()){
                $this->view('dashboard');
            }else{
                $data =[];
                $this->view('login', $data);
            }
        }

        //for login
        public function signing($email = '', $password = ''){
            if($this->isLoggedIn()){
                $this->view('dashboard');
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
                    $data = [];
                    
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
                if($electionRow->Supervisor == $_SESSION["UserId"]){
                    $data = [];

                    $candidateRow = $this->candidateModel->getCandidatesByElectionId($id);
                    $positionRow = $this->positionModel->getElectionPositionByElectionId($id);
                    $partyRow = $this->partyModel->getPartiesByElectionId($id);

                    $data['electionRow'] = $electionRow;
                    $data['candidateRow'] = $candidateRow;
                    $data['positionRow'] = $positionRow;
                    $data['partyRow'] = $partyRow;
                    
                    $this->view('Supervisor/electionCandidates',$data);
                }else{
                    echo "Forbidden Access";
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

                    //dummy data
                    $nominationRow = array(
                        array(1,"John Doe",21,"Party1"),
                        array(2,"Jane Pow",22,"Party2"),
                        array(3,"John DoW",21,"Party3"),
                        array(4,"Jane Now",22,"Party4"),
                        array(5,"John Mow",23,"Party5"),
                    );

                    $positionRow = array(
                        array(21,"President"),
                        array(22,"Vice President"),
                        array(23,"Secretary"),
                        array(24,"Treasurer"),
                    );

                    $this->view('Supervisor/electionNominations',$data);
                }else{
                    echo "Forbidden Access";
                }
            }
        }
    }