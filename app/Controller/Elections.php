<?php
    class Elections extends Controller{

        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function crteelection(){
            if(!$this->isLoggedIn()){
                $this->view('login');
            }else{
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    $data =[
                        'orgname' => trim($_POST[""]),
                        'title' => trim($_POST[""]),
                        'description' => trim($_POST[""]),
                        'esd' => trim($_POST[""]),
                        'eed' => trim($_POST[""]),
                        'est' => trim($_POST[""]),
                        'eet' => trim($_POST[""]),
                        'obj' => trim($_POST[""]),
                        'osd' => trim($_POST[""]),
                        'oed' => trim($_POST[""]),
                        'ost' => trim($_POST[""]),
                        'oet' => trim($_POST[""]),
                        'stat' => trim($_POST[""])
                    ];

                    
                }
            }
        }

    }

?>