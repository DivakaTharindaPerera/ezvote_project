<?php

    class Controller{


        public function __construct(){

            // $this->postModel = $this->model('User');
        }

        public function model($model){

            require_once '../app/Model/' . $model . '.php';

            return new $model();
        }

        public function view($view, $data = []){
            if(file_exists('../app/View/'.$view.'.php')){
                require_once '../app/View/'.$view.'.php';
            }else{
                die('View does not exist');
            }
        }

        //for login
        public function logged($email, $password, $users){
                foreach($users as $user){
                    if($user->Email === $email){
                        if(password_verify($password, $user->Password)){
                            
                            session_start();
                            
                            //to prevent the session attacks 
                            session_regenerate_id();
                            
                            $_SESSION["UserId"] = $user->UserId;
                            $_SESSION["fname"] = $user->Fname;
                            $_SESSION["lname"] = $user->Lname;
                            $_SESSION["email"] = $user->Email;
                            
                            $this->view('dashboard');
                        }else{
                            $data = [
                                'error' => "invalid password",
                                'email' => $email
                            ]; 
                            $this->view('login',$data);
                        }
                    }            
                }
        }

        public function logout(){
            unset($_SESSION['UserId']);
            session_start();
            session_destroy();

            redirect('View/login');
        }

        public function isLoggedIn(){
            if(isset($_SESSION['UserId'])){
                return true;
            }else{
                return false;
            }
        }

    }