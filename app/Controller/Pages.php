<?php
    session_start();
    class Pages extends Controller{
        private $postModel;
        public function __construct(){
            $this->postModel = $this->model('User');
            
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
    }