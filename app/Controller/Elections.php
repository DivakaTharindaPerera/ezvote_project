<?php
class Elections extends Controller
{
    private $userModel;
    private $electionModel;
    private $voterModel;
    private $positionModel;
    private $partyModel;
    private $candidateModel;
    private $emailModel;

    public function __construct()
    {
        $this->emailModel = $this->model('Email');
        $this->userModel = $this->model('User');
        $this->electionModel = $this->model('Election');
        $this->voterModel = $this->model('Voter');
        $this->positionModel = $this->model('electionPositions');
        $this->partyModel = $this->model('Party');
        $this->candidateModel = $this->model('Candidate');
    }

    public function sendEmail(){
        echo "landed correctly";
        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $data = [
                'email' => trim($_POST['email']),
                'subject' => trim($_POST['subject']),
                'body' => trim($_POST['body'])
            ];
            if($this->emailModel->sendEmail($data)){
                echo "Email sent";
            }else{
                echo "Email not sent";
            }
        } 
    }
    
    public function crteelection()
    {
        if (!$this->isLoggedIn()) {
            $this->view('login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
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

                if (trim($_POST["selfnomination"])) {
                    $data['sn'] = 1;
                    $data['nomi_description'] = trim($_POST["nomi_description"]);
                }


                if (trim($_POST["objectionstatus"])) {
                    $data['obj'] = 1;
                    $data['osd'] = trim($_POST["OstartDate"]);
                    $data['oed'] = trim($_POST["OendDate"]);
                    $data['ost'] = trim($_POST["OstartTime"]);
                    $data['oet'] = trim($_POST["OendTime"]);
                }
                if (trim($_POST["statVisibality"])) {
                    $data['stat'] = 1;
                }
                //run query
                $this->electionModel->insertIntoElection($data);
            }

        }
    }

    //testing function
    public function findElection(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $data = [
                'electionId' => trim($_POST["electionId"])
            ];

            $row = $this->electionModel->findElectionById($data['electionId']);
            echo $row->Title;
        }
    }

    public function insertvoters()
    {
        $flag = 1;
        if (!$this->isLoggedIn()) {
            $this->view('login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $electionId = trim($_POST["electionId"]);
                $count = trim($_POST["count"]);

                for ($i = 1; $i <= $count; $i++) {
                    $data = [
                        'electionId' => $electionId,
                        'name' => trim($_POST[$i . "name"]),
                        'id' => "",
                        'email' => trim($_POST[$i . "email"]),
                        'value' => trim($_POST[$i . "value"])

                    ];
                    $ElectionData = $this->electionModel->findElectionById($data['electionId']);
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $user = $this->userModel->getUserByEmail($data['email']);
                        $data['id'] = $user->UserId;
                        if ($this->voterModel->insertIntoRegVoters($data)) {
                            $data1 = [
                                'email' => $data['email'],
                                'subject' => "ELECTION REQUEST FROM " . $ElectionData->OrganizationName,
                                'body' => "You have been invited to participate as a voter in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". Please login to your account see further infromation about the election."
                            ];
                            $this->emailModel->sendEmail($data1);
                            continue;
                        } else {
                            $flag = 0;
                            break;
                        }
                    } else {
                        if ($this->voterModel->insertIntoUnregVoters($data)) {
                            $data1 = [
                                'email' => $data['email'],
                                'subject' => "ELECTION REQUEST FROM " . $ElectionData->OrganizationName,
                                'body' => "You have been invited to participate as a voter in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". Please create an account to place your vote for the election."
                            ];
                            $this->emailModel->sendEmail($data1);
                            continue;
                        } else {
                            $flag = 0;
                            break;
                        }
                    }
                }
                if ($flag == 1) {
                    $this->view('Supervisor/addPositions', $data);
                } else {
                    echo "Error";
                }
            }
        }
    }

    public function insertPositions()
    {
        if (!$this->isLoggedIn()) {
            $this->view('login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // echo "<table border='1'>";
                // foreach ($_POST as $key => $value) {
                //     echo "<tr>";
                //     echo "<td>";
                //     echo $key;
                //     echo "</td>";
                //     echo "<td>";
                //     echo $value;
                //     echo "</td>";
                //     echo "</tr>";
                // }
                // echo "</table>";
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $electionId = trim($_POST["electionId"]);
                $count = trim($_POST["count"]);
                $positionData = [
                    "electionId" => $electionId,
                    "positionName" => [],
                    "positionId" => []
                ];
                for ($i = 1; $i <= $count; $i++) {
                    $data = [
                        'electionId' => $electionId,
                        'position' => trim($_POST[$i . "positionName"]),
                        'description' => trim($_POST[$i . "desc"]),
                        'noOfOptions' => trim($_POST[$i . "noOfOptions"]),
                        'count' => $count
                    ];

                    if ($id = $this->positionModel->insertIntoElectionPositions($data)) {
                        array_push($positionData["positionName"], $data['position']);
                        array_push($positionData["positionId"], $id);
                        continue;
                    } else {
                        echo "error $i <br>";
                        $this->view('Supervisor/addPositions', $data);
                        return;
                    }
                }
                $this->view('Supervisor/addCandidates', $positionData);
            }
        }
    }

    public function insertParty()
    {
        if (!$this->isLoggedIN()) {
            $this->view('login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $electionId = trim($_POST["electionId"]);
                $count = trim($_POST["count"]);
                $partyCount = trim($_POST["partyCount"]);

                for($k = 0 ; $k < $count; $k++){
                    echo $electionId."-".trim($_POST[$k."party"])."-".trim($_POST[$k."name"])."-".trim($_POST[$k."email"])."-".trim($_POST[$k."position"])."<br>";
                }

                for ($i = 0; $i < $partyCount; $i++) {
                    $data = [
                        'electionId' => $electionId,
                        'partyName' => trim($_POST["partyName" . $i]),
                        'supName' => trim($_POST["partySupName" . $i]),
                        'supEmail' => trim($_POST["partySupEmail" . $i]),
                        'userId' => ""
                    ];
                    $ElectionData = $this->electionModel->findElectionById($data['electionId']);
                    if ($this->userModel->findUserByEmail($data['supEmail'])) {
                        $user = $this->userModel->getUserByEmail($data['supEmail']);
                        $data['userId'] = $user->UserId;
                        
                        if ($partyId = $this->partyModel->insertIntoParty2($data)) {
                            $data1 = [
                                'email' => $data['supEmail'],
                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                'body' => "You have been added as the party supervisor in the party ".$data['partyname']." in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please login to your account see further infromation."
                            ];
                            $this->emailModel->sendEmail($data1);
                            for ($j = 0; $j < $count; $j++) {
                                
                                if (trim($_POST[$j . "party"]) == $data['partyName']) {
                                    $data1 = [
                                        'electionId' => $electionId,
                                        'partyId' => $partyId,
                                        'candidateName' => trim($_POST[$j . "name"]),
                                        'candidateEmail' => trim($_POST[$j . "email"]),
                                        'positionId' => trim($_POST[$j . "position"]),
                                        'userId' => ""
                                    ];

                                    if ($this->userModel->findUserByEmail($data1['candidateEmail'])) {
                                        $user = $this->userModel->getUserByEmail($data1['candidateEmail']);
                                        $data1['userId'] = $user->UserId;
                                        if ($id = $this->candidateModel->insertRegCandidate($data1)) {
                                            echo "success" . $id . "<br>";
                                            continue;
                                        } else {
                                            echo "error $i <br>";
                                            $this->view('Supervisor/addCandidate', $data);
                                            return;
                                        }
                                    }else{
                                        if ($id = $this->candidateModel->insertUnregCandidate($data1)) {
                                            echo "success" . $id . "<br>";
                                            continue;
                                        } else {
                                            echo "error $i <br>";
                                            $this->view('Supervisor/addCandidate', $data);
                                            return;
                                        }
                                    }
                                }else if(trim($_POST[$j . "party"]) == "No Party"){
                                    $data1 = [
                                        'electionId' => $electionId,
                                        'partyId' => NULL,
                                        'candidateName' => trim($_POST[$j . "name"]),
                                        'candidateEmail' => trim($_POST[$j . "email"]),
                                        'positionId' => trim($_POST[$j . "position"]),
                                        'userId' => ""
                                    ];

                                    if ($this->userModel->findUserByEmail($data1['candidateEmail'])) {
                                        $user = $this->userModel->getUserByEmail($data1['candidateEmail']);
                                        $data1['userId'] = $user->UserId;
                                        if ($id = $this->candidateModel->insertRegCandidate($data1)) {
                                            echo "success" . $id . "<br>";
                                            continue;
                                        } else {
                                            echo "error $i <br>";
                                            $this->view('Supervisor/addCandidate', $data);
                                            return;
                                        }
                                    }else{
                                        if ($id = $this->candidateModel->insertUnregCandidate($data1)) {
                                            echo "success" . $id . "<br>";
                                            continue;
                                        } else {
                                            echo "error $i <br>";
                                            $this->view('Supervisor/addCandidate', $data);
                                            return;
                                        }
                                    } 
                                }
                            }
                            continue;
                        } else {
                            echo "error $i <br>";
                            $this->view('Supervisor/addCandidate', $data);
                            return;
                        }
                    } else {
                        if ($partyId = $this->partyModel->insertIntoParty1($data)) {
                            $data1 = [
                                'email' => $data['supEmail'],
                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                'body' => "You have been added as the party supervisor in the party ".$data['partyname']." in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please create an account in ezvote.lk to access the party control panel."
                            ];
                            $this->emailModel->sendEmail($data1);
                            for ($j = 0; $j < $count; $j++) {
                                
                                if (trim($_POST[$j . "party"]) == $data['partyName']) {
                                    $data1 = [
                                        'electionId' => $electionId,
                                        'partyId' => $partyId,
                                        'candidateName' => trim($_POST[$j . "name"]),
                                        'candidateEmail' => trim($_POST[$j . "email"]),
                                        'positionId' => trim($_POST[$j . "position"]),
                                        'userId' => ""
                                    ];

                                    if ($this->userModel->findUserByEmail($data1['candidateEmail'])) {
                                        $user = $this->userModel->getUserByEmail($data1['candidateEmail']);
                                        $data1['userId'] = $user->UserId;
                                        if ($id = $this->candidateModel->insertRegCandidate($data1)) {
                                            $data2 = [
                                                'email' => $data['candidateEmail'],
                                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                                'body' => "You have been added as a candidate representing the party ".$data['partyName']." in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please login to your account to access the election candidate panel."
                                            ];
                                            $this->emailModel->sendEmail($data2);
                                            continue;
                                        } else {
                                            echo "error $i <br>";
                                            $this->view('Supervisor/addCandidate', $data);
                                            return;
                                        }
                                    }else{
                                        if ($id = $this->candidateModel->insertUnregCandidate($data1)) {
                                            $data2 = [
                                                'email' => $data['candidateEmail'],
                                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                                'body' => "You have been added as a candidate representing the party ".$data['partyName']." in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please create an account in ezvote.lk to access the election."
                                            ];
                                            $this->emailModel->sendEmail($data2);
                                            continue;
                                        } else {
                                            echo "error $i <br>";
                                            $this->view('Supervisor/addCandidate', $data);
                                            return;
                                        }
                                    }
                                }
                            }
                            continue;
                        } else {
                            echo "error $i <br>";
                            $this->view('Supervisor/addCandidate', $data);
                            return;
                        }
                    }
                }
            }
        }
    }

    public function updateElection(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data=[
            "id"=>trim($_POST['id']),
            "title"=>trim($_POST['title']),
            "org"=>trim($_POST['org']),
            "desc"=>trim($_POST['desc']),

            "esdate"=>trim($_POST['EstartDate']),
            "eedate"=>trim($_POST['EendDate']),
            "estime"=>trim($_POST['EstartTime']),
            "eetime"=>trim($_POST['EendTime']),

            "osdate"=>trim($_POST['OstartDate']),
            "oedate"=>trim($_POST['OendDate']),
            "ostime"=>trim($_POST['OstartTime']),
            "oetime"=>trim($_POST['OendTime']),

            "status"=>trim($_POST['stat']),

            "nomi"=>trim($_POST['nomi']),
            "nomidesc"=>trim($_POST['nomiDesc']),

            "ostat"=>trim($_POST['ostat'])
        ];

        if($this->electionModel->updateElection($data)){
            redirect('Pages/viewMyElection/'.$data['id']);
        }else{
            die('Something went wrong');
        }
    }

}
