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
    private $logModel;

    public function __construct()
    {
        $this->emailModel = $this->model('Email');
        $this->userModel = $this->model('User');
        $this->electionModel = $this->model('Election');
        $this->voterModel = $this->model('Voter');
        $this->positionModel = $this->model('electionPositions');
        $this->partyModel = $this->model('Party');
        $this->candidateModel = $this->model('Candidate');
        $this->logModel = $this->model('log');
    }

    public function sendEmail()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $data = [
                'email' => trim($_POST['email']),
                'subject' => trim($_POST['subject']),
                'body' => trim($_POST['body'])
            ];
            echo "sending emails... Please sit tight....";

            ob_flush();
            flush();

            for ($i = 0; $i < 10; $i++) {
                if ($this->emailModel->sendEmail($data)) {
                    continue;
                } else {
                    echo "Email not sent $i";
                }
            }

            echo "<br>Emails sent successfully";
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
    public function findElection()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                            $logDesc = "Voter " . $data['name'] . " has been added to the election " . $ElectionData->Title;
                            $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

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
                            $logDesc = "Voter " . $data['name'] . " has been added to the election " . $ElectionData->Title;
                            $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

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
                    redirect('Pages/wayToAddPositions/' . $data['electionId']);
                    // $this->view('Supervisor/addPositions', $data);
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

                        $logDesc = "Position " . $data['position'] . " has been added to the election " . $data['electionId'];
                        $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

                        array_push($positionData["positionName"], $data['position']);
                        array_push($positionData["positionId"], $id);
                        continue;
                    } else {
                        echo "error $i <br>";
                        redirect('Pages/wayToAddPositions/' . $data['electionId']);
                    }
                }
                redirect('Pages/wayToAddCandidates/' . $data['electionId']);
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

                for ($k = 0; $k < $count; $k++) {
                    echo $electionId . "-" . trim($_POST[$k . "party"]) . "-" . trim($_POST[$k . "name"]) . "-" . trim($_POST[$k . "email"]) . "-" . trim($_POST[$k . "position"]) . "<br>";
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

                            $logDesc = "Party " . $data['partyName'] . " has been added to the election " . $data['electionId'];
                            $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

                            $data1 = [
                                'email' => $data['supEmail'],
                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                'body' => "You have been added as the party supervisor in the party " . $data['partyName'] . " in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please login to your account see further infromation."
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

                                            $logDesc = "Candidate " . $data1['candidateName'] . " has been added to the election " . $data1['electionId'];
                                            $this->logModel->saveLog($logDesc, $data1['electionId'], $_SESSION["UserId"]);

                                            echo "success" . $id . "<br>";
                                            continue;
                                        } else {
                                            echo "error $i <br>";
                                            $this->view('Supervisor/addCandidates', $data);
                                            return;
                                        }
                                    } else {
                                        if ($id = $this->candidateModel->insertUnregCandidate($data1)) {

                                            $logDesc = "Candidate " . $data1['candidateName'] . " has been added to the election " . $data1['electionId'];
                                            $this->logModel->saveLog($logDesc, $data1['electionId'], $_SESSION["UserId"]);

                                            echo "success" . $id . "<br>";
                                            continue;
                                        } else {
                                            echo "error $i <br>";
                                            $this->view('Supervisor/addCandidate', $data);
                                            return;
                                        }
                                    }
                                } else if (trim($_POST[$j . "party"]) == "No Party") {
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

                                            $logDesc = "Candidate " . $data1['candidateName'] . " has been added to the election " . $data1['electionId'];
                                            $this->logModel->saveLog($logDesc, $data1['electionId'], $_SESSION["UserId"]);

                                            echo "success" . $id . "<br>";
                                            continue;
                                        } else {
                                            echo "error $i <br>";
                                            $this->view('Supervisor/addCandidate', $data);
                                            return;
                                        }
                                    } else {
                                        if ($id = $this->candidateModel->insertUnregCandidate($data1)) {

                                            $logDesc = "Candidate " . $data1['candidateName'] . " has been added to the election " . $data1['electionId'];
                                            $this->logModel->saveLog($logDesc, $data1['electionId'], $_SESSION["UserId"]);

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

                            $logDesc = "Party " . $data['partyName'] . " has been added to the election " . $data['electionId'];
                            $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

                            $data1 = [
                                'email' => $data['supEmail'],
                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                'body' => "You have been added as the party supervisor in the party " . $data['partyname'] . " in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please create an account in ezvote.lk to access the party control panel."
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

                                            $logDesc = "Candidate " . $data1['candidateName'] . " has been added to the election " . $data1['electionId'];
                                            $this->logModel->saveLog($logDesc, $data1['electionId'], $_SESSION["UserId"]);

                                            $data2 = [
                                                'email' => $data['candidateEmail'],
                                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                                'body' => "You have been added as a candidate representing the party " . $data['partyName'] . " in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please login to your account to access the election candidate panel."
                                            ];
                                            $this->emailModel->sendEmail($data2);
                                            continue;
                                        } else {
                                            echo "error $i <br>";
                                            $this->view('Supervisor/addCandidate', $data);
                                            return;
                                        }
                                    } else {
                                        if ($id = $this->candidateModel->insertUnregCandidate($data1)) {

                                            $logDesc = "Candidate " . $data1['candidateName'] . " has been added to the election " . $data1['electionId'];
                                            $this->logModel->saveLog($logDesc, $data1['electionId'], $_SESSION["UserId"]);

                                            $data2 = [
                                                'email' => $data['candidateEmail'],
                                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                                'body' => "You have been added as a candidate representing the party " . $data['partyName'] . " in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please create an account in ezvote.lk to access the election."
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
                            return;
                        }
                    }
                }
            }
            $this->view('Supervisor/addCandidateSuccess', '1');
        }
    }


    public function updateElection()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            "id" => trim($_POST['id']),
            "title" => trim($_POST['title']),
            "org" => trim($_POST['org']),
            "desc" => trim($_POST['desc']),

            "esdate" => trim($_POST['EstartDate']),
            "eedate" => trim($_POST['EendDate']),
            "estime" => trim($_POST['EstartTime']),
            "eetime" => trim($_POST['EendTime']),

            "osdate" => trim($_POST['OstartDate']),
            "oedate" => trim($_POST['OendDate']),
            "ostime" => trim($_POST['OstartTime']),
            "oetime" => trim($_POST['OendTime']),

            "status" => trim($_POST['stat']),

            "nomi" => trim($_POST['nomi']),
            "nomidesc" => trim($_POST['nomiDesc']),

            "ostat" => trim($_POST['ostat'])
        ];

        if ($this->electionModel->updateElection($data)) {

            $logDesc = "Election " . $data['title'] . " has been updated";
            $this->logModel->saveLog($logDesc, $data['id'], $_SESSION["UserId"]);

            redirect('Pages/viewMyElection/' . $data['id']);
        } else {
            die('Something went wrong');
        }
    }

    public function addSingleCandidate()
    {
        if (!$this->isLoggedIn()) {
            $this->view('login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'electionId' => trim($_POST['id']),
                    'candidateName' => trim($_POST['candidateName']),
                    'candidateEmail' => trim($_POST['candidateEmail']),
                    'positionId' => trim($_POST['positionId']),
                    'partyId' => trim($_POST['party'])
                ];

                $ElectionData = $this->electionModel->findElectionById($data['electionId']);
                $PartyData = $this->partyModel->getPartyById($data['partyId']);

                if ($data['partyId'] == "NULL") {
                    if ($this->userModel->findUserByEmail($data['candidateEmail'])) {
                        $user = $this->userModel->getUserByEmail($data['candidateEmail']);
                        $data['userId'] = $user->UserId;
                        if ($id = $this->candidateModel->insertRegCandidatePartyNull($data)) {

                            $logDesc = "Candidate " . $data['candidateName'] . " has been added to the election " . $data['electionId'];
                            $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

                            $data2 = [
                                'email' => $data['candidateEmail'],
                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                'body' => "You have been added as a candidate in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please login to your account to access the election candidate panel."
                            ];
                            $this->emailModel->sendEmail($data2);

                            redirect('Pages/electionCandidates/' . $data['electionId']);
                        }
                    } else {
                        if ($id = $this->candidateModel->insertUnregCandidatePartyNull($data)) {

                            $logDesc = "Candidate " . $data['candidateName'] . " has been added to the election " . $data['electionId'];
                            $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

                            $data2 = [
                                'email' => $data['candidateEmail'],
                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                'body' => "You have been added as a candidate in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please create an account in ezvote.lk to access the election."
                            ];
                            $this->emailModel->sendEmail($data2);

                            redirect('Pages/electionCandidates/' . $data['electionId']);
                        }
                    }
                } else {
                    if ($this->userModel->findUserByEmail($data['candidateEmail'])) {
                        $user = $this->userModel->getUserByEmail($data['candidateEmail']);
                        $data['userId'] = $user->UserId;
                        if ($id = $this->candidateModel->insertRegCandidate($data)) {

                            $logDesc = "Candidate " . $data['candidateName'] . " has been added to the election " . $data['electionId'];
                            $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

                            $data2 = [
                                'email' => $data['candidateEmail'],
                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                'body' => "You have been added as a candidate representing the party " . $PartyData->partyName . " in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please login to your account to access the election candidate panel."
                            ];
                            $this->emailModel->sendEmail($data2);

                            redirect('Pages/electionCandidates/' . $data['electionId']);
                        }
                    } else {
                        if ($id = $this->candidateModel->insertUnregCandidate($data)) {

                            $logDesc = "Candidate " . $data['candidateName'] . " has been added to the election " . $data['electionId'];
                            $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

                            $data2 = [
                                'email' => $data['candidateEmail'],
                                'subject' => "ALERT FROM " . $ElectionData->OrganizationName,
                                'body' => "You have been added as a candidate representing the party " . $PartyData->partyName . " in the election " . $ElectionData->Title . " by " . $ElectionData->OrganizationName . ". <br> Please create an account in ezvote.lk to access the election."
                            ];
                            $this->emailModel->sendEmail($data2);

                            redirect('Pages/electionCandidates/' . $data['electionId']);
                        }
                    }
                }
            }
        }
    }

    public function removeCandidate()
    {
        if (!$this->isLoggedIn()) {
            $this->view('login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $id = trim($_POST['id']);
                $eid = trim($_POST['eid']);
                if ($this->candidateModel->deleteCandidate($id)) {

                    $logDesc = "Candidate " . $id . " has been removed from the election " . $eid;
                    $this->logModel->saveLog($logDesc, $eid, $_SESSION["UserId"]);

                    redirect('Pages/electionCandidates/' . $eid);
                } else {
                    die('<h1>Something went wrong<h1>');
                }
            }
        }
    }

    public function updateCandidate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                "id" => trim($_POST['id']),
                "cid" => trim($_POST['cId']),
                "cname" => trim($_POST['cName']),
                "cemail" => trim($_POST['cEmail']),
                "cparty" => trim($_POST['cParty']),
            ];

            if ($this->userModel->findUserByEmail($data['cemail'])) {
                $user = $this->userModel->getUserByEmail($data['cemail']);
                $data['cuser'] = $user->UserId;

                if ($this->candidateModel->updateCandidateWithUser($data)) {

                    $logDesc = "Candidate " . $data['cid'] . " has been updated in the election " . $data['id'];
                    $this->logModel->saveLog($logDesc, $data['id'], $_SESSION["UserId"]);

                    redirect('Pages/electionCandidates/' . $data['id']);
                } else {
                    die('Something went wrong');
                }
            } else {
                if ($this->candidateModel->updateCandidate($data)) {

                    $logDesc = "Candidate " . $data['cid'] . " has been updated in the election " . $data['id'];
                    $this->logModel->saveLog($logDesc, $data['id'], $_SESSION["UserId"]);

                    redirect('Pages/electionCandidates/' . $data['id']);
                } else {
                    die('Something went wrong');
                }
            }
        }
    }

    public function addSinglePosition()
    {
        if (!$this->isLoggedIn()) {
            $this->view('login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // $data = [
                //     'id' => trim($_POST['electionId']),
                //     'name' => trim($_POST['positionName']),
                //     'desc' => trim($_POST['positionDesc']),
                // ];
                try {
                    $dataset = json_decode(file_get_contents('php://input'), true);
                    $data = [
                        'msg' => 'success',
                        'id' => $dataset['electionId'],
                        'name' => $dataset['positionName'],
                        'desc' => $dataset['positionDesc'],
                        'count' => $dataset['noOfOptions'],
                        'position' => $dataset['positionName'],
                        'description' => $dataset['positionDesc'],
                        'electionId' => $dataset['electionId'],
                        'noOfOptions' => $dataset['noOfOptions'],
                    ];

                    $positionList = $this->positionModel->getElectionPositionByElectionId($data['id']);

                    foreach ($positionList as $position) {
                        if ($position->positionName == $data['name']) {
                            $data['msg'] = 'Position Already exists';
                            echo json_encode($data);
                            return;
                        }
                    }

                    if ($this->positionModel->insertIntoElectionPositions($data)) {

                        $logDesc = "Position " . $data['name'] . " has been added to the election " . $data['id'];
                        $this->logModel->saveLog($logDesc, $data['id'], $_SESSION["UserId"]);

                        echo json_encode($data);
                    } else {
                        $data['msg'] = 'Error occured. Try again later...';
                        echo json_encode($data);
                    }
                } catch (Exception $e) {
                    echo json_encode(array('msg' => 'error occured.. ' . $e));
                }
            }
        }
    }

    public function updatePosition()
    {
        if (!$this->isLoggedIn()) {
            $this->view('login');
        } else {
            try {
                $dataset = json_decode(file_get_contents('php://input'), true);
                $data = [
                    'msg' => 'success',
                    'eid' => $dataset['eId'],
                    'id' => $dataset['pId'],
                    'name' => $dataset['pName'],
                    'desc' => $dataset['pDesc'],
                    'noOfOptions' => $dataset['pNoOfOptions']
                ];

                $positionList = $this->positionModel->getElectionPositionByElectionId($data['eid']);
                foreach ($positionList as $position) {
                    if ($position->positionName == $data['name']) {
                        $data['msg'] = 'A position with the same name already exists. Try a different name.';
                        echo json_encode($data);
                        return;
                    }
                }
                if ($this->positionModel->updatePosition($data)) {

                    $logDesc = "Position " . $data['name'] . " has been updated in the election " . $data['eid'];
                    $this->logModel->saveLog($logDesc, $data['eid'], $_SESSION["UserId"]);

                    echo json_encode($data);
                } else {
                    $data['msg'] = 'Error occured. Try again later...';
                    echo json_encode($data);
                }
            } catch (Exception $e) {
                $data['msg'] = 'Error occured. Try again later...' . $e;
                echo json_encode($data);
                return;
            }
        }
    }

    public function deletePosition()
    {
        if (!$this->isLoggedIn()) {
            $this->view('login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => trim($_POST['id']),
                    'eid' => trim($_POST['eid'])
                ];

                if ($this->positionModel->deletePosition($data['id'])) {

                    $logDesc = "Position " . $data['id'] . " has been deleted from the election " . $data['eid'];
                    $this->logModel->saveLog($logDesc, $data['eid'], $_SESSION["UserId"]);

                    redirect('Pages/electionCandidates/' . $data['eid']);
                } else {
                    die('Something went wrong');
                }
            }
        }
    }

    public function addSingleVoter()
    {
        if (!$this->isLoggedIn()) {
            $this->view('login');
        } else {
            try {
                $dataset = json_decode(file_get_contents('php://input'), true);
                $data = [
                    'msg' => 'success',
                    'electionId' => $dataset['id'],
                    'name' => $dataset['name'],
                    'email' => $dataset['email'],
                    'value' => $dataset['value'],
                ];

                if ($this->voterModel->findDuplicateVoters($data['email'], $data['electionId'])) {
                    $data['msg'] = 'A voter with this email already registered for this election';
                    echo json_encode($data);
                    return;
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $user = $this->userModel->getUserByEmail($data['email']);
                        $data['id'] = $user->UserId;

                        if ($this->voterModel->insertIntoRegVoters($data)) {

                            $logDesc = "Voter " . $data['name'] . " has been added to the election " . $data['electionId'];
                            $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);
                            echo json_encode($data);
                            return;
                        } else {
                            $data['msg'] = 'Error occured. Try again later...';
                            echo json_encode($data);
                            return;
                        }
                    } else {
                        if ($this->voterModel->insertIntoUnregVoters($data)) {

                            $logDesc = "Voter " . $data['name'] . " has been added to the election " . $data['electionId'];
                            $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

                            echo json_encode($data);
                            return;
                        } else {
                            $data['msg'] = 'Error occured. Try again later...';
                            echo json_encode($data);
                            return;
                        }
                    }
                }
            } catch (Exception $e) {
                $data['msg'] = 'Error occured. Try again later...' . $e;
                echo json_encode($data);
                return;
            }
        }
    }

    public function removeVoter()
    {
        if (!$this->isLoggedIn()) {
            $this->view('login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'eid' => trim($_POST['eid']),
                    'id' => trim($_POST['voterId'])
                ];

                $voterName = $this->voterModel->getVoterByVoterId($data['id'])->Name;

                if ($this->voterModel->deleteVoterByVoterId($data['id'])) {

                    $logDesc = "Voter " . $voterName . " has been deleted from the election " . $data['eid'];
                    $this->logModel->saveLog($logDesc, $data['eid'], $_SESSION["UserId"]);

                    redirect('Pages/electionVoters/' . $data['eid']);
                } else {
                    die('Something went wrong');
                }
            }
        }
    }

    public function editVoter()
    {
        $dataset = json_decode(file_get_contents('php://input'), true);
        $data = [
            'msg' => 'success',
            'eid' => $dataset['eid'],
            'id' => $dataset['voterId'],
            'name' => $dataset['name'],
            'email' => $dataset['email'],
            'value' => $dataset['value'],
            'oldEmail' => $dataset['oldEmail']
        ];

        if ($data['email'] != $data['oldEmail'] && $this->voterModel->findDuplicateVoters($data['email'], $data['eid'])) {
            $data['msg'] = "A voter with this email is already registered for this election";
            echo json_encode($data);
            return;
        } else {

            if ($this->userModel->findUserByEmail($data['email'])) {
                $user = $this->userModel->getUserByEmail($data['email']);
                $data['uid'] = $user->UserId;

                if ($this->voterModel->editVoterWithUser($data)) {

                    $logDesc = "Voter " . $data['name'] . " has been edited in the election " . $data['eid'];
                    $this->logModel->saveLog($logDesc, $data['eid'], $_SESSION["UserId"]);

                    echo json_encode($data);
                    return;
                } else {
                    $data['msg'] = "Something went wrong. Try again later...";
                    echo json_encode($data);
                    return;
                }
            } else {
                if ($this->voterModel->editVoterWithoutUser($data)) {

                    $logDesc = "Voter " . $data['name'] . " has been edited in the election " . $data['eid'];
                    $this->logModel->saveLog($logDesc, $data['eid'], $_SESSION["UserId"]);

                    echo json_encode($data);
                    return;
                } else {
                    $data['msg'] = "Something went wrong. Try again later...";
                    echo json_encode($data);
                    return;
                }
            }
            // if($this->voterModel->editUnregVoter($data)){
            //     echo json_encode($data);
            //     return;
            // }else{
            //     $data['msg'] = "Something went wrong. Try again later...";
            //     echo json_encode($data);
            //     return;
            // }
        }
    }

    public function addSingleParty()
    {
        try {
            $dataset = json_decode(file_get_contents('php://input'), true);
            $data = [
                'msg' => 'success',
                'electionId' => $dataset['electionId'],
                'partyName' => $dataset['partyName'],
                'supName' => $dataset['supervisorName'],
                'supEmail' => $dataset['supervisorEmail']
            ];

            if ($this->partyModel->findDuplicateParty($data['electionId'], $data['partyName'])) {
                $data['msg'] = 'A party with the same name already exists. Try a different name.';
                echo json_encode($data);
                return;
            } else {
                if ($this->userModel->findUserByEmail($data['supEmail'])) {
                    $user = $this->userModel->getUserByEmail($data['supEmail']);
                    $data['userId'] = $user->UserId;

                    if ($this->partyModel->insertIntoParty2($data)) {

                        $logDesc = "Party " . $data['partyName'] . " has been added to the election " . $data['electionId'];
                        $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

                        echo json_encode($data);
                        return;
                    } else {
                        $data['msg'] = 'Error occured. Try again later...';
                        echo json_encode($data);
                        return;
                    }
                } else {
                    if ($this->partyModel->insertIntoParty1($data)) {

                        $logDesc = "Party " . $data['partyName'] . " has been added to the election " . $data['electionId'];
                        $this->logModel->saveLog($logDesc, $data['electionId'], $_SESSION["UserId"]);

                        echo json_encode($data);
                        return;
                    } else {
                        $data['msg'] = 'Error occured. Try again later...';
                        echo json_encode($data);
                        return;
                    }
                }
            }
        } catch (exception $e) {
            $data['msg'] = 'Error occured. Try again later...' . $e;
            echo json_encode($data);
            return;
        }
    }

    public function editSingleParty()
    {
        try {
            $dataset = json_decode(file_get_contents('php://input'), true);

            $data = [
                'eid' => $dataset['electionId'],
                'msg' => 'success',
                'partyId' => $dataset['partyId'],
                'partyName' => $dataset['partyName'],
                'supName' => $dataset['supervisorName'],
                'supEmail' => $dataset['supervisorEmail'],
                'oldPartyName' => $dataset['oldPartyName']
            ];

            if ($data['partyName'] != $data['oldPartyName'] && $this->partyModel->findDuplicateParty($data['eid'], $data['partyName'])) {
                $data['msg'] = 'A party with the same name already exists. Try a different name.';
                echo json_encode($data);
                return;
            } else {
                if ($this->userModel->findUserByEmail($data['supEmail'])) {
                    $user = $this->userModel->getUserByEmail($data['supEmail']);
                    $data['userId'] = $user->UserId;

                    if ($this->partyModel->editPartyWithUser($data)) {

                        $logDesc = "Party " . $data['partyName'] . " has been edited in the election " . $data['eid'];
                        $this->logModel->saveLog($logDesc, $data['eid'], $_SESSION["UserId"]);

                        echo json_encode($data);
                        return;
                    } else {
                        $data['msg'] = 'Error occured. Try again later...';
                        echo json_encode($data);
                        return;
                    }
                } else {
                    if ($this->partyModel->editPartyWithoutUser($data)) {

                        $logDesc = "Party " . $data['partyName'] . " has been edited in the election " . $data['eid'];
                        $this->logModel->saveLog($logDesc, $data['eid'], $_SESSION["UserId"]);

                        echo json_encode($data);
                        return;
                    } else {
                        $data['msg'] = 'Error occured. Try again later...';
                        echo json_encode($data);
                        return;
                    }
                }
            }
        } catch (Exception $e) {
            $data['msg'] = 'Error occured. Try again later...' . $e;
            echo json_encode($data);
            return;
        }
    }

    public function removeParty()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'eid' => trim($_POST['electionId']),
                'id' => trim($_POST['partyId'])
            ];

            if ($this->partyModel->deletePartyByPartyId($data['id'])) {
                $partyName = $this->partyModel->getPartyById($data['id'])->partyName;

                $logDesc = "Party " . $partyName . " has been removed from the election " . $data['eid'];
                $this->logModel->saveLog($logDesc, $data['eid'], $_SESSION["UserId"]);

                redirect('Pages/electionParties/' . $data['eid']);
            } else {
                die('Something went wrong');
            }
        }
    }

    public function removeElection($eid){
        if(!$this->isLoggedIn()){
            $this->view('login');
        }else{
            $election = $this->electionModel->getElectionByElectionId($eid);
            if($election->Supervisor == $_SESSION['UserId']){
                if($this->electionModel->deleteElection($eid)){
                    $logDesc = "Election " . $election->ElectionName . " has been removed";
                    $this->logModel->saveLog($logDesc, $eid, $_SESSION["UserId"]);
                    redirect('Pages/viewMyElections');
                }else{
                    die('Something went wrong');
                }

            }

        }
    }
}

