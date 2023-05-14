<?php
class Voters extends Controller
{
    private $objModel;
    private $elecModel;
    private $voterModel;
    private $objectionModel;
    private $partyModel;
    private $candidateModel;
    private $voteModel;
    private $encryptModel;
    private $userModel;
    private $votingModel;
    private $conferenceModel;
    private $nominateModel;
    private $partyOwnerRequestModel;
    private $positionModel;
    private $discussionModel;
    
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

        $this->nominateModel = $this->model('Nomination');
        $this->partyOwnerRequestModel = $this->model('PartyOwnerRequest');
        $this->positionModel = $this->model('electionPositions');
        $this->discussionModel = $this->model('Discussion');

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
                $result = $this->partyOwnerRequestModel->getPartyRequestsByElectionAndUser($election_id,$_SESSION['UserId']);
                $this->view('Voter/viewElection', [
                    'election' => $data_1,
                    'positions' => $data_2,
                    'candidates' => $data_3,
                    'conferences' => $data_6,
                    'result' => $result
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
                $voterId=$this->voterModel->findVoterByUserIdAndElectionId($_SESSION['UserId'],$electionId);
                $data=[
                    'parentQuestionId'=>$_POST['Pcommentid'],
                    'name'=>$_POST['name'],
                    'message'=>trim($_POST['msg']),
                    'date'=>date('Y-m-d H:i:s'),
                    'electionId'=>$electionId,
                    'voterId'=>$voterId->voterId,
                    'candidateId'=>$candidateId,
                ];
                if($this->discussionModel->insertQuestion($data)){
                    redirect('Voters/election/'.$electionId);
                }else{
                    die('Something went wrong');
                }

            }
        }
        $user_id=$_SESSION['UserId'];
//
        $result = $this->voterModel->findVoterByUserIdAndElectionId($user_id,$electionId);

        $result2 = $this->candidateModel->findCandidateByUserIdAndElectionId($user_id,$electionId);
        // var_dump($result2);
        // exit;
        $this->view('Voter/questioning',['result' => $result,'result2' => $result2]);
    }

    public function nomination_apply($id)
    {
        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{
        if (isset($_POST['save'])) {

            //form data is filtered and sanitized using filter_input_array()
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
               
            //call getParty_Id method of the nominateModel object
            $party_id = $_POST['party_name'];
            $position_id = $_POST['position'];

            $imageName = $_FILES['imgfile']['name'];
            // var_dump($imageName);
            $imageTmpName = $_FILES['imgfile']['tmp_name'];
            // var_dump($imageTmpName);
            $imageType = $_FILES['imgfile']['type'];
            // var_dump($imageType);
            $imageSize = $_FILES['imgfile']['size'];
            // var_dump($imageSize);
            $folder1 = "../public/img/candidate/profileImages/" . $imageName;
            move_uploaded_file($imageTmpName, $folder1);


            $filename2 = $_FILES["file"]["name"];
            // var_dump($filename2);
            $tempname2 = $_FILES["file"]["tmp_name"];
            // var_dump($tempname2);
            $folder2 = "../public/img/candidate/proofDocuments/" . $filename2;
            move_uploaded_file($tempname2, $folder2);

            $data = [
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'email' => $_SESSION["email"],
                'ID' => $position_id,
                'PartyId' => $party_id,
                'profile_picture' => $imageName,
                'identity_proof' => $filename2,
                'candidateDescription' => trim($_POST['candidateDescription']),
                'msg' => trim($_POST['msg']),
                'elect_id' => $id,

                'fname_err' => '',
                'lname_err' => '',
                'profilepic_err' => '',
                'identityproof_err' => '',
                'description_err' => '',
                'msg_err' => '',
            ];

            //validate data

            if (empty($data['firstname'])) {
                $data['fname_err'] = 'Please enter first name';
            }

            if (empty($data['lastname'])) {
                $data['lname_err'] = 'Please enter last name';
            }

            if (empty($data['profile_picture'])) {
                $data['profilepic_err'] = 'Please attach profile picture';
            }

            if (empty($data['identity_proof'])) {
                $data['identityproof_err'] = 'Please attach identity proof documents';
            }

            if (empty($data['candidateDescription'])) {
                $data['description_err'] = 'Please enter candidateDescription';
            }

            if (empty($data['msg'])) {
                $data['msg_err'] = 'Please enter msg';
            }

            //make sure no errors
            if (empty($data['fname_err']) && empty($data['lname_err']) && empty($data['profilepic_err']) &&  empty($data['identityproof_err']) && empty($data['description_err']) && empty($data['msg_err'])) {
                //validated

                //call AddNomination method of the nominateModel object
                if ($this->nominateModel->AddNomination($data)) {
                    // var_dump($data);
                    // exit;
                    redirect('Voters/nominationSuccessful');
                } else {
                    die('Something went wrong');
                }

                //If the form is not submitted
            } else {
                
                $names = $this->elecModel->getUpcomingElections();
                $positions = $this->positionModel->getElectionPositions();
                $parties = $this->partyModel->getElectionParties();

                //renders the applyNomination view, passing the data array
                $this->view('Voters/applyNomination/'.$id, ['names' => $names, 'positions' => $positions, 'parties' => $parties,'data'=>$data]);
            }
        } else {
            //If there are no form submissions and no data, a default empty data array is created
            $data = [

                'firstname' => '',
                'lastname' => '',
                'profile_picture' => '',
                'identity_proof' => '',
                'candidateDescription' => '',
                'msg' => '',
            ];
            $this->view('Candidate/nomination_apply', $data);
        }
    }
}

public function party_apply()
{
    if (!isset($_SESSION["UserId"])) {
        header("Location: " . urlroot . "/View/Login");
        exit;
    }else{
    if (isset($_POST['save'])) {
        // $names = 0;

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // var_dump($_POST);
        // exit;
        $party_id = $this->nominateModel->getParty_Id($_POST['party_name']);

        $filename2 = $_FILES["file"]["name"];
        // var_dump($filename2);
        $tempname2 = $_FILES["file"]["tmp_name"];
        // var_dump($tempname2);
        $folder2 = "../public/img/candidate/proofDocuments/" . $filename2;
        move_uploaded_file($tempname2, $folder2);
        $sup_id=$this->partyModel->findPartyNameById($party_id);

        $sup=$sup_id[0]->userId;
        $data = [
            'firstname' => trim($_POST['firstname']),
            'lastname' => trim($_POST['lastname']),
            'ElectionID' => $_POST['elect_id'],
            // 'ID' => $position_id,
            'PartyId' => $party_id,
            'identity_proof' => $filename2,
            // 'candidateDescription' => trim($_POST['candidateDescription']),
            'msg' => trim($_POST['msg']),
            'user_Id'=> $sup,
            'candidate_id'=>$_SESSION['UserId'],// user id from the form data.  probably a global variable.  probably not needed.  just using it for


            'fname_err' => '',
            'lname_err' => '',
            'identityproof_err' => '',
            'description_err' => '',
            'msg_err' => '',
        ];

        //validate data

        if (empty($data['firstname'])) {
            $data['fname_err'] = 'Please enter first name';
        }

        if (empty($data['lastname'])) {
            $data['lname_err'] = 'Please enter last name';
        }

        if (empty($data['identity_proof'])) {
            $data['identityproof_err'] = 'Please attach identity proof documents';
        }

        if (empty($data['msg'])) {
            $data['msg_err'] = 'Please enter msg';
        }

        //make sure no errors
        if (empty($data['identityproof_err']) && empty($data['msg_err'])) {
            //validated
            if ($this->partyOwnerRequestModel->AddPartyRequest($data)) {
                redirect('Voters/applyPartySuccessful');
            } else {
                die('Something went wrong');
            }
        } else {
            $parties = $this->partyModel->getElectionParties();

            $this->view('Candidate/applyParty', ['parties' => $parties,'data'=>$data]);

        }
    } else {
        $data = [

            'firstname' => '',
            'lastname' => '',
            'profile_picture' => '',
            'identity_proof' => '',
            'candidateDescription' => '',
            'msg' => '',

        ];

        $this->view('Candidate/party_apply', $data);
    }
}
}

    public function applyNomination($elect_id)
    {
//        $query = []; // empty array

        //iterate through each element in the $_GET superglobal array
//        foreach ($_GET as $key => $value) {
//            $query[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
//        }
        
        // $names = $this->electModel->getUpcomingElections();

        //call getElectionPositionByElectionId method of the positionModel object
        $positions = $this->positionModel->getElectionPositionByElectionId(intval($elect_id));
        $parties = $this->partyModel->getPartiesByElectionId(intval($elect_id));
        $email = $_SESSION['email'];

        //renders the applyNomination view, passing the data array including $positions, $parties, $email
        $this->view('Candidate/applyNomination', ['positions' => $positions, 'parties' => $parties, 'email' => $email,'elect_id'=>$elect_id]);
    }

    public function applyParty($id)
    {
        $parties = $this->partyModel->getPartiesByElectionId(intval($id));

        //renders the applyNomination view, passing the data array including  $parties
        $this->view('Candidate/applyParty', ['parties' => $parties,'elect_id'=>$id]);
    }


    public function nominationSuccessful()
    {
        $this->view('Candidate/nominationSuccessful');
    }

    public function applyPartySuccessful()
    {
        $this->view('Candidate/applyPartySuccessful');
    }


}
