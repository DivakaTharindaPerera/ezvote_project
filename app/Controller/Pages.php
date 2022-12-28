<?php

    class Pages extends Controller{

        public function __construct(){
            $this->postModel = $this->model('User');
        }

        public function index(){
            // $posts = $this->postModel->getPosts();
            $data = [
                'title' => 'Welcome',
                // 'posts' => $posts
            ];
            $this->view('index', $data);
        }

        public function about(){
           
        }  
        
        public function register(){
            $data =[];
            $this->view('register', $data);
        }

        public function login(){
            $data =[];
            $this->view('login', $data);
        }

        //for login
        public function signing($email = '', $password = ''){
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $this->logged($email, $password, $this->postModel->getUsers());
            }else{
                $this->view('login');
            }
        }
    }