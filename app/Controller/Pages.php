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
                $this->view('../View/home.php');

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

        public function viewMyElection($id){
            if(!isset($_SESSION["UserId"])){
                redirect('View/login');
            }else{
                $data = [];

                $electionRow = $this->electionModel->getElectionByElectionId($id);
                $electionRow = $this->electionModel->getElectionByElectionId($id);
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
            }
        }
    
    public function aboutUs(){
        $this->view('about_us');
    }

    public function contactUs(){
        $this->view('contact_us');
    }
}