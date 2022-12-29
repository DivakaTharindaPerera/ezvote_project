<?php
    class Elections extends Controller{

        public function __construct(){
            $this->userModel = $this->model('User');
            $this->electionModel = $this->model('Election');
        }

        public function crteelection(){
            if(!$this->isLoggedIn()){
                $this->view('login');
            }else{
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $data =[
                        'orgname' => trim($_POST["orgName"]),
                        'title' => trim($_POST["electionTitle"]),
                        'description' => trim($_POST["description"]),
                        'esd' => trim($_POST["EstartDate"]),
                        'eed' => trim($_POST["EendDate"]),
                        // 'sn' => trim($_POST["selfnomination"]),
                        'sn' => 0,
                        'est' => trim($_POST["EstartTime"]),
                        'eet' => trim($_POST["EendTime"]),
                        // 'obj' => trim($_POST["objectionstatus"]),
                        'obj' => 0,
                        // 'osd' => trim($_POST["OstartDate"]),
                        // 'oed' => trim($_POST["OendDate"]),
                        // 'ost' => trim($_POST["OstartTime"]),
                        // 'oet' => trim($_POST["OendTime"]),
                        'osd' => NULL,
                        'oed' => NULL,
                        'ost' => NULL,
                        'oet' => NULL,
                        // 'stat' => trim($_POST["statVisibality"]),
                        'stat' => 0,
                        // 'nomi_description' => trim($_POST["nomi_description"])
                        'nomi_description' => NULL
                    ];

                    if(trim($_POST["selfnomination"])){
                        $data['sn'] = 1;
                        $data['nomi_description'] = trim($_POST["nomi_description"]);
                    }


                    if(trim($_POST["objectionstatus"])){
                        $data['obj'] = 1;
                        $data['osd'] = trim($_POST["OstartDate"]);
                        $data['oed'] = trim($_POST["OendDate"]);
                        $data['ost'] = trim($_POST["OstartTime"]);
                        $data['oet'] = trim($_POST["OendTime"]);
                    }
                    if(trim($_POST["statVisibality"])){
                        $data['stat'] = 1;
                    }
                    //run query
                    if($this->electionModel->insertIntoElection($data)){
                        $this->view('/Supervisor/addVoters');
                    }else{
                        die("Something went wrong");
                    }

                }


                    

            }
        }

    }

?>