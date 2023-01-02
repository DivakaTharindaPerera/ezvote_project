<?php
    class Elections extends Controller{
        private $userModel;
        private $electionModel;
        private $voterModel;
        
        public function __construct(){
            $this->userModel = $this->model('User');
            $this->electionModel = $this->model('Election');
            $this->voterModel = $this->model('Voter');
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
                    $this->electionModel->insertIntoElection($data);
                }


                    

            }
        }

        public function insertvoters(){
            if(!$this->isLoggedIn()){
                $this->view('login');
            }else{
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $electionId = trim($_POST["electionId"]);
                    $count = trim($_POST["count"]);

                    for($i = 1; $i <= $count; $i++){
                        $data = [
                            'electionId' => $electionId,
                            'name' => trim($_POST[$i."name"]),
                            'id' => "",
                            'email' => trim($_POST[$i."email"]),
                            'value' => trim($_POST[$i."value"])

                        ];
                        if($this->userModel->findUserByEmail($data['email'])){
                            $user = $this->userModel->getUserByEmail($data['email']);
                            $data['id'] = $user->UserId;
                            $this->voterModel->insertIntoRegVoters($data);
                        }else{
                            $this->voterModel->insertIntoUnregVoters($data);
                        }

                    }
                }
            }
        }

    }

?>