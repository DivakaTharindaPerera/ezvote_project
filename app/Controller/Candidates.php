<?php

class Candidates extends Controller
{

    public function __construct()
    {
        $this->nominateModel = $this->model('Nomination');
        $this->objectModel = $this->model('Objection');
        $this->discussionModel = $this->model('discussion');
        $this->candidateModel = $this->model('candidate');
        $this->electModel = $this->model('Election');
        $this->positionModel = $this->model('electionPositions');
        $this->partyModel = $this->model('Party');
        $this->partyOwnerRequestModel = $this->model('PartyOwnerRequest');
        $this->userModel = $this->model('User');
        $this->voterModel = $this->model('Voter');
        $this->mailModel = $this->model('Email');


  
    }

    public function nomination_apply()
    {
        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{
        if (isset($_POST['save'])) {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $party_id = $this->nominateModel->getParty_Id($_POST['party_name']);
            $position_id = $this->nominateModel->getPosition_Id($_POST['position']);

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
                'ID' => $position_id,
                'PartyId' => $party_id,
                'profile_picture' => $imageName,
                'identity_proof' => $filename2,
                'candidateDescription' => trim($_POST['candidateDescription']),
                'msg' => trim($_POST['msg']),

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
                if ($this->nominateModel->AddNomination($data)) {
                    redirect('Candidates/nominationSuccessful');
                } else {
                    die('Something went wrong');
                }
            } else {
                
                $names = $this->electModel->getUpcomingElections();
                $positions = $this->positionModel->getElectionPositions();
                $parties = $this->partyModel->getElectionParties();

                $this->view('Candidate/applyNomination', ['names' => $names, 'positions' => $positions, 'parties' => $parties,'data'=>$data]);
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

        $data = [
            'firstname' => trim($_POST['firstname']),
            'lastname' => trim($_POST['lastname']),
            'ElectionID' => $_POST['elect_id'],
            // 'ID' => $position_id,
            'PartyId' => $party_id,
            'identity_proof' => $filename2,
            // 'candidateDescription' => trim($_POST['candidateDescription']),
            'msg' => trim($_POST['msg']),
            'user_Id'=> $_SESSION['UserId'],  // user id from the form data.  probably a global variable.  probably not needed.  just using it for


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
                redirect('Candidates/applyPartySuccessful');
            } else {
                die('Something went wrong');
            }
        } else {
            $parties = $this->partyModel->getElectionParties();

            $this->view('Candidate/applyParty', ['names' => $names,'parties' => $parties,'data'=>$data]);

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

    // public function update_candidate_profile()
    // {

    //     //        if(!$this->isLoggedIn()){
    //     //            echo 'log in';
    //     //        }
    //     //        else{


    //     // if($this->IsPost()){

    //     // $nominationID = uniqid('obj',true);
    //     $candidateName = $_POST['candidateName'];
    //     $candidateEmail = $_POST['candidateEmail'];
    //     $position = $_POST['position'];
    //     $party_name = $_POST['party_name'];
    //     // // 'profile_picture'=>$_FILES['imgfile'],
    //     // // 'identity_proof'=>$_FILES['file'],
    //     $description = $_POST['description'];
    //     $vision = $_POST['vision'];
    //     if (isset($_POST['update'])) {

    //         // $res = $this->nominateModel->updateCandidateProfile($nominationID,$firstname,$lastname,$election_name,$position,$party_name,$candidateDescription,$msg);

    //         // if($res){
    //         //     header("Location: ../View/Candidate/candidateProfile.php");
    //         // }
    //         // else{
    //         //     header("Location: ../View/Candidate/candidateProfile.php");
    //         // }


    //         // if($this->IsPost()){

    //         // $nominationID = uniqid('obj',true);
    //         $candidateName = $_POST['candidateName'];
    //         $candidateEmail = $_POST['candidateEmail'];
    //         $position = $_POST['position'];
    //         $party_name = $_POST['party_name'];
    //         // // 'profile_picture'=>$_FILES['imgfile'],
    //         // // 'identity_proof'=>$_FILES['file'],
    //         $description = $_POST['description'];
    //         $vision = $_POST['vision'];
    //         if (isset($_POST['update'])) {

    //             $res = $this->nominateModel->updateCandidateProfile($nominationID, $firstname, $lastname, $election_name, $position, $party_name, $candidateDescription, $msg);

    //             if ($res) {
    //                 header("Location: ../View/Candidate/candidateProfile.php");
    //             } else {
    //                 header("Location: ../View/Candidate/candidateProfile.php");
    //             }
    //         }
    //     }
    // }

    public function applyNomination()
    {
        $query = [];
        foreach ($_GET as $key => $value) {
            $query[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        
        // $names = $this->electModel->getUpcomingElections();
        $positions = $this->positionModel->getElectionPositionByElectionId(intval($query['id']));
        $parties = $this->partyModel->getPartiesByElectionId(intval($query['id']));

        $this->view('Candidate/applyNomination', ['positions' => $positions, 'parties' => $parties]);
    }

    public function applyParty($id)
    {
        $parties = $this->partyModel->getPartiesByElectionId(intval($id));

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

    // public function objections(){
    //     $this->view('Candidate/objections');
    // }

    public function updateProfile()
    {
        $this->view('Candidate/updateProfile');
    }

    public function candidateProfile($id)
    {

        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{

            $candidate_id=$id;

            $res = $this->candidateModel->getCandidateProfile($candidate_id);
            // var_dump($res);
            // exit;
            $elect= $this->electModel->findelectNameById($res[0]->electionid);
            $position= $this->positionModel->findPositionNameById($res[0]->positionId);
            $party= $this->partyModel->findPartyNameById($res[0]->partyId);
            // var_dump($party);
            // die();
            $user_id=$_SESSION["UserId"];
            $res2 = $this->candidateModel->getCandidateByUserId($user_id);
            // var_dump($res2);
            // exit;
            $res3 = $this->candidateModel->findCandidateByUserIdAndCandidateId($user_id,$candidate_id);
            // var_dump($res3);
            // exit;
            $this->view('Candidate/candidateProfile', ['res' => $res,'elect' => $elect, 'party' => $party, 'position' => $position, 'res2' => $res2, 'res3' => $res3]);
            
        }
        // echo "<h3>" . htmlspecialchars($_SESSION["fname"]) . " " . htmlspecialchars($_SESSION["lname"]) . "</h3>";
        // $r=$this->nominateModel->RetrieveAll();
        // $this->view('Candidate/candidateProfile',['r'=>$r]);

    }

    public function objections($id,$eid)
    {
        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{
        $candidate_id=$id;
        $election_id=$eid;
        $r = $this->nominateModel->findObjectionBycandidateIdAndElectionId($candidate_id,$election_id);
        // var_dump($r);
        // exit;
        $this->view('Candidate/objections', ['r' => $r]);
    }
}

    public function respondObjection($id,$eid)
    {
        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = [
                // 'objectionID'=>uniqid('obj',true),
                'Respond' => $_POST['Description'],
                'ObjectionID' => $_POST['ObjectionID'],
                // 'Respond'=>'',
                // 'ElectionID'=>1281,
                // 'CandidateID'=>20,
                // 'VoterID'=>6,
            ];
            $this->nominateModel->respondToObjection($data);
        }
        redirect('Candidates/objections/' .$id.'/'.$eid);
    }
    }

    
    public function createPost()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'msg' => $_POST['msg'],
            ];
            if ($this->discussionModel->insertPost($data)) {
                echo json_encode(['statusCode' => 200]);
            } else {
                echo json_encode(['statusCode' => 201]);
            }
        }
        // $this->view('Candidate/discussionForum');
    }

    public function viewPost()
    {
        $data = array();
        $result = $this->discussionModel->viewDiscussion();
        $data = $result;

        echo json_encode($data);
    }

    public function discussionForum($electionId)
    {
        $user_id=$_SESSION['UserId'];
       
        $result = $this->voterModel->findVoterByUserIdAndElectionId($user_id,$electionId);
        // var_dump($result);
        // exit;
        $result2 = $this->candidateModel->findCandidateByUserIdAndElectionId($user_id,$electionId);
        // var_dump($result2);
        // exit;
        $this->view('Candidate/discussionForum',['result' => $result,'result2' => $result2]);
    }

    public function viewElections()
    {
        $this->view('Candidate/viewElections');
    }

    public function viewAllElections()
    {
        $this->view('Candidate/viewAllElections');
    }

    public function conferences()
    {
        $this->view('Candidate/conferences');
    }

    public function my_party()
    {
        $this->view('Candidate/my_parties');
    }

    public function partyRequests()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'request_id' => $_POST['request_id'],
                'candidate_id' => $_POST['candidate_id'],
                'reason' => $_POST['reason'],
            ];

            $this->partyOwnerRequestModel->partyRejected($data);
            $user=$this->userModel->getUserByUserId($_SESSION['UserId']);

            $subject = "Party Request Rejected";
            $msg = "Your party request is rejected because " . $data['reason'];
                
            $emailData = [
                'email' => $user[0]->Email,
                'subject' => $subject,
                'body' => $msg
                ];
            try {
                $this->mailModel->sendEmail($emailData);
            } catch (Exception $e) {
                echo "Message could not be sent. Please try again later.";
            }
            redirect('Candidates/partyRequests');

        }
        else{

            $res = $this->userModel->getUserByUserId($_SESSION["UserId"]);
            
            $res2 = $this->partyModel->getPartyByEmail($res[0]->Email);

            // var_dump();
            // exit;
            if(!empty($res2)){
            $requests=$this->partyOwnerRequestModel->getPartyRequests($_SESSION["UserId"]);
            // var_dump($requests);
            // exit;
            
            $election=[];
            foreach ($requests as $row){
                $election_id= $row->election_id;
                // var_dump($election_id);
                // exit;
                $elect=$this->electModel->findelectNameById($election_id);
                // var_dump($row->request_id);
                // exit;
                $election[$row->request_id]=$elect[0]->OrganizationName.$elect[0]->Title;
            }

            $this->view('Candidate/partyRequests', ['request' => $requests, 'electName' => $election]);
            }else{
                redirect('pages/dashboard');
            }
        }
    }

    public function acceptPartyRequest($request_id,$candidate_id)
    {
        $user=$this->userModel->getUserByUserId($_SESSION['UserId']);
        $this->partyOwnerRequestModel->partyAccepted($request_id);
        $subject = "Party Request is Accepted";
        $msg = "Your party request is accepted.
                Please log into <a href='" . urlroot . "'>ezvote</a> and apply for the nomination.";
        
        $emailData = [
            'email' => $user[0]->Email,
            'subject' => $subject,
            'body' => $msg
        ];

        try {
            $this->mailModel->sendEmail($emailData);
        } catch (Exception $e) {
            echo "Message could not be sent. Please try again later.";
        }
        redirect('Candidates/partyRequests');
    }

   
    public function election_results()
    {
        $this->view('Candidate/election_results');
    }
    
    public function update_profile()
    {
        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{
             
        // $candidate_id=$_SESSION["UserId"];
        //     // var_dump($candidate_id);
        //     // exit;
        // $res = $this->candidateModel->getCandidateProfileByUserId($candidate_id);
        // // var_dump($res);
        // //     exit;
        // $elect= $this->electModel->findelectNameById($res[0]->electionid);
        // // var_dump($elect);
        // //     exit;
        // $position= $this->positionModel->findPositionNameById($res[0]->positionId);
        
        // $party= $this->partyModel->findPartyNameById($res[0]->partyId);
        // // var_dump($party);
        // // exit;

        // $this->view('Candidate/updateProfile', ['res' => $res,'elect' => $elect, 'party' => $party, 'position' => $position]);
        // $this->view('Candidate/updateProfile');
        // redirect('Candidates/update_profile');


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = [
                'candidateId' => $_POST['candidateid'],
                'candidateName' => $_POST['candidateName'],
                'description' => $_POST['description'],
                'vision' => $_POST['vision'],
            ];
            
            $this->candidateModel->updateCandidateProfile($data);
            // var_dump($data['candidateId']);
            // exit;
            $id=intval($data['candidateId']);
            redirect('Candidates/candidateProfile/'.$id);
        }
        // $this->view('Candidate/updateProfile');
        // redirect('Candidates/candidateProfile');
        } 
    }

    public function showElectionNames(){
        $names = $this->electModel->getUpcomingElections();
        $this->view('Candidate/applyNomination', ['names' => $names]);
    }

    public function election($election_id,$candidate_id = null)
    {
        if ($this->isLoggedIn()) {
            $data_1 = $this->electModel->getElectionByElectionId($election_id);
            $data_2 = $this->electModel->getPositionsByElectionId($election_id);
            $data_3 = $this->electModel->getCandidatesByElectionId($election_id);
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
                redirect('candidates/election/' . $election_id);
            } else {
                $result = $this->partyOwnerRequestModel->getPartyRequestsByElectionAndUser($election_id,$_SESSION['UserId']);
                // var_dump($result);
                // exit;
                
                $this->view('Candidate/viewCandidateElection', [
                    'election' => $data_1,
                    'positions' => $data_2,
                    'candidates' => $data_3,
                    'result' => $result,
                ]);
            }
        } else {
            $this->view('login');
        }
    }
}
