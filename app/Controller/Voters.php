<?php
class Voters extends Controller
{
    public function __construct()
    {
        $this->objModel = $this->model('Objection');
        $this->elecModel = $this->model('Election');
        $this->voterModel = $this->model('Voter');
        $this->objectionModel = $this->model('Objection');
        $this->partyModel = $this->model('Party');
        $this->candidateModel = $this->model('Candidate');
        $this->voteModel = $this->model('Vote');
        $this->encryptModel = $this->model('userEncrypt');
        $this->userModel = $this->model('User');
        $this->votingModel = $this->model('Voting');
        $this->conferenceModel = $this->model('Conference');
    }
    public function submitObjections()
    {
        //        if(!$this->isLoggedIn()){
        //            echo 'log in';
        //        }
        //        else{

        if ($this->IsPost()) {
            //            $this->objModel->setSubject($_POST['Subject']);
            //            $this->objModel->setDescription($_POST['Description']);
            //            $this->objModel->AddObjection();
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'objectionID' => uniqid('obj', true),
                'Subject' => trim($_POST['Subject']),
                'Description' => trim($_POST['Description']),
                'Respond' => '',
                'Action' => '',
                'ElectionID' => 1251,
                'CandidateID' => 'can01',
                'VoterID' => 48,
                'SubjectError' => '',
                'DescriptionError' => ''
            ];
            //validate data
            if (empty($data['Subject'])) {
                $data['Subject_err'] = 'Please enter a subject';
            }
            if (empty($data['Description'])) {
                $data['Description_err'] = 'Please enter a description';
            }
            //make sure no errors
            if (empty($data['Subject_err']) && empty($data['Description_err'])) {
                //validated
                if ($this->objModel->AddObjection($data)) {
                    //                    flash('register_success','You have successfully submitted your objection');
                    redirect('voters/election');
                } else {
                    die('Something went wrong');
                }
            } else {
                //load view with errors
                $this->view('Voters/submitObjections', $data);
            }
        } else {
            $data = [
                'Subject' => '',
                'Description' => ''
            ];
            $this->view('voters/submitObjections', $data);
        }
    }

    public function election($election_id,$candidate_id = null)
    {
        if ($this->isLoggedIn()) {
            $data_1 = $this->elecModel->getElectionByElectionId($election_id);
            $data_2 = $this->elecModel->getPositionsByElectionId($election_id);
            $data_3 = $this->elecModel->getCandidatesByElectionId($election_id);
            $data_4 = $this->votingModel->getVoterByUidAndEid($_SESSION['UserId'],$election_id);
            $vID=$data_4->voterId;
            $data_5 = $this->conferenceModel->getConferencesByElectionID($election_id);
            foreach ($data_5 as $conference){
                if($conference->ParticipantsV==1){
                    $data_6[]=$conference;
                };
            }
//            $data_5 = $this->conferenceModel->getConferencesByVoterIDAndElectionID($vID,$election_id);
//            $data_6=[];
//            foreach ($data_5 as $conference){
//                $con_id=$conference->conferenceID;
//                $data_6[]=$this->conferenceModel->getConferenceByConferenceID($con_id);
//            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_id = $_SESSION['UserId'];
                $voter_id = $this->voterModel->getVoterByUserId($user_id)->voterId;
                $candidate_id = $_POST['CandidateID'];
                $data = [
                    'objectionID' => uniqid('obj', true),
                    'Subject' => $_POST['Subject'],
                    'Description' => $_POST['Description'],
                    'Respond' => '',
                    'Action' => '',
                    'ElectionID' => $election_id,
                    'CandidateID' => $candidate_id,
                    'VoterID' => $voter_id
                ];
                $this->objModel->AddObjection($data);
                redirect('voters/election/' . $election_id);
            }
            else {
                $this->view('Voter/viewElection', [
                    'election' => $data_1,
                    'positions' => $data_2,
                    'candidates' => $data_3,
                    'conferences' => $data_6
                ]);
            }
        } else {
            $this->view('login');
        }
    }

    public function viewObjections($candidate_id, $election_id)
    {
        //        $r=$this->objModel->RetrieveAll();
        $data_1 = $this->objModel->showObjectionsByElectionAndCandidateId($election_id, $candidate_id);
//        $data_2 = $this->objModel->getCandidateName($candidate_id);
        $data_2=$this->objModel->getCandidateByCandidateID($candidate_id);
        $data_3=$this->userModel->getUserById($data_2->userId);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $this->objModel->DeleteObjection($id);
            //            $this->view('Voter/viewObjections',['r'=>$r]);
        }
        $this->view('Voter/viewObjections', [
            //            'r'=>$r,
            'objections' => $data_1,
            'candidate' => $data_2,
            'user'=>$data_3
        ]);
    }

    public function vote($id = null, $candidate_id = null)
    {
        //        unset($_SESSION['tmpElection']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //            print_r($_POST);
            //            exit();
            $electionID = $_POST['election_id'];
            $positionID = $_POST['position_id'];
            $candidateID = $_POST['candidate_id'];
            $tempElection = $_SESSION['tmpElection'];
            if (empty($tempElection)) {
                $_SESSION['tmpElection'] = [
                    $electionID => [
                        $positionID => $candidateID
                    ]
                ];
            } else {
                if (array_key_exists($electionID, $tempElection)) {
                    if (array_key_exists($positionID, $tempElection[$electionID])) {
                        var_dump($candidateID);
                        //                        exit();
                        $tempElection[$electionID][$positionID] = $candidateID;
                    } else {
                        $tempElection[$electionID][$positionID] = $candidateID;
                    }
                } else {
                    $tempElection[$electionID] = [
                        $positionID => $candidateID
                    ];
                }
            }
            print_r($_SESSION['tmpElection']);
            exit();
        }
        $data_1 = $this->elecModel->getElectionByElectionId($id);
        $data_2 = $this->elecModel->getPositionsByElectionId($id);
        $data_3 = $this->elecModel->getCandidatesByElectionId($id);
        $data_4 = $this->userModel->getUsers();
        $this->view('Voter/votingBallot', [
            'election' => $data_1,
            'positions' => $data_2,
            'candidates' => $data_3,
            'id' => $id,
            'users'=>$data_4
        ]);
    }

    public function summary($electionId)
    {
        if($this->isLoggedIn()){
            $election = $this->elecModel->getElectionByElectionId($electionId);
            $candidates = $this->candidateModel->getCandidatesByElectionId($electionId);
            $positions = $this->elecModel->getPositionsByElectionId($electionId);
            $voters = $this->voterModel->getVotersByElectionId($electionId);
            $parties = $this->partyModel->getPartiesByElectionId($electionId);
            $votes=$this->calculateVotes($electionId);
            $this->view('Voter/electionSummary', [
                'election' => $election,
                'positions' => $positions,
                'voters' => $voters,
                'candidates' => $candidates,
                'parties' => $parties,
                'votes' => $votes
            ]);
        }
        else{
            $this->view('login');
        }
        return true;
    }

    public function temporaryVotes()
    {
        $data_1 = $this->voterModel->temporaryVoting();
        $this->view('Voter/temporaryVotes', [
            'votes' => $data_1
        ]);
    }
    public function submitObjection()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $eid = trim($_POST['electionId']);
            $voterRow = $this->voterModel->getVoterByUserIdAndELectionId($_SESSION['UserId'], $eid);
            $data =[
                'voterId' =>$voterRow->voterId,
                'electionId' =>$eid,
                'candidateId' =>trim($_POST['candidateId']),
                'subject' =>trim($_POST['Subject']),
                'description' =>trim($_POST['Description'])
            ];

            if($this->objectionModel->insertObjection($data)){
                redirect('Voters/election/'.$eid);
            }else{
                die('Something went wrong');
            }
        }
    }

    public function encrypt($data, $key, $iv)
    {
        $encryptedData = openssl_encrypt($data, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        $encryptedData = base64_encode($encryptedData);
        return $encryptedData;
    }

    public function decrypt($data, $key, $iv)
    {
        $decryptedData = base64_decode($data);
        $decryptedData = openssl_decrypt($decryptedData, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }

    public function verifyCandidate($eid, $cid)
    {
        $candidate = $this->candidateModel->getCandidateByCandidateId($cid);
        $election = $this->elecModel->getElectionByElectionId($eid);
        if ($election->ElectionId == $candidate->electionid) {
            return true;
        } else {
            return false;
        }
    }

    public function calculateVotes($eid)
    {
        $candidates = array();
        $voters = $this->voterModel->getVotersByElectionId($eid);
        $candidateRows = $this->candidateModel->getCandidatesByElectionId($eid);
        foreach ($candidateRows as $candidateRow) {
            $candidates[$candidateRow->candidateId] = 0;
        }
        foreach ($voters as $voter) {
            // echo $voter->voterId."<br>";
            $encryption = $this->encryptModel->getKeyAndIv($voter->voterId);
            $votes = $this->voteModel->retrieveVotes($voter->voterId);
            foreach ($votes as $vote) {
                $candidate = $this->decrypt($vote->candidate, $encryption->Key, $encryption->Iv);
                // echo $candidate."<br>";
                if ($this->verifyCandidate($eid, $candidate)) {
                    $candidates[$candidate] += $voter->value;
                }
            }
        }

        // $keys = array_keys($candidates);

        // echo "Candidates : Votes <br>";
        // foreach($keys as $key){
        //     echo $key . " : " . $candidates[$key] . "<br>";
        // }

        return $candidates;
    }

    public function qAndA($electionId,$candidateId)
    {
        if($this->isLoggedIn()){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'question'=>trim($_POST['question']),
                    'electionId'=>$electionId,
                    'candidateId'=>$candidateId,
                ];
                if($this->voterModel->insertQuestion($data)){
                    redirect('Voters/election/'.$electionId);
                }else{
                    die('Something went wrong');
                }
            }
        }
        $user_id=$_SESSION['UserId'];

        $result = $this->voterModel->findVoterByUserIdAndElectionId($user_id,$electionId);
        // var_dump($result);
        // exit;
        $result2 = $this->candidateModel->findCandidateByUserIdAndElectionId($user_id,$electionId);
        // var_dump($result2);
        // exit;
        $this->view('Voter/questioning',['result' => $result,'result2' => $result2]);
    }


}
