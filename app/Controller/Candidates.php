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
  
    }

    public function nomination_apply()
    {
        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{
        if (isset($_POST['save'])) {


            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // var_dump($_POST);
            $elect_id = $this->nominateModel->getElect_Id($_POST['election_name']);
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

            // var_dump($elect_id);
            // var_dump($party_id);
            // var_dump($position_id);

            $data = [
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'ElectionID' => $elect_id,
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
            
            // if($imageSize > 100){
            //     $data['profilepic_err'] ='Image size must be less than 5MB';
            // }

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
                //load view with errors
                $names = $this->electModel->getUpcomingElections();
                $positions = $this->positionModel->getElectionPositions();
                $parties = $this->partyModel->getElectionParties();

                $this->view('Candidate/applyNomination', ['names' => $names, 'positions' => $positions, 'parties' => $parties,'data'=>$data]);
                // $this->view('Candidate/applyNomination', $data);
            }
        } else {
            $data = [

                'firstname' => '',
                'lastname' => '',
                'profile_picture' => '',
                'identity_proof' => '',
                'candidateDescription' => '',
                'msg' => '',

                // 'firstname_err'=>'',
                // 'lastname_err'=>'',
                // 'election_name_err'=>'',
                // 'position_err'=>'',
                // 'party_name_err'=>'',
                // 'profile_picture_err'=>'',
                // 'identity_proof_err'=>'',
                // 'party_description_err'=>'',
                // 'candidateDescription_err'=>'',
                // 'msg_err'=>''
            ];
            // echo "2";
            $this->view('Candidate/nomination_apply', $data);
        }
    }
}

//     public function update_candidate_profile()
//     {
//         if (!isset($_SESSION["UserId"])) {
//             header("Location: " . urlroot . "/View/Login");
//             exit;
//         }else{
//                 // if($this->IsPost()){

//                         // $nominationID = uniqid('obj',true);
//                         $candidateName = $_POST['candidateName'];
//                         $candidateEmail = $_POST['candidateEmail'];
//                         $position = $_POST['position'];                
//                         $party_name = $_POST['party_name'];
//                         // // 'profile_picture'=>$_FILES['imgfile'],
//                         // // 'identity_proof'=>$_FILES['file'],
//                         $description = $_POST['description'];
//                         $vision = $_POST['vision'];
//                         if(isset($_POST['update'])){

//                         // $res = $this->nominateModel->updateCandidateProfile($nominationID,$firstname,$lastname,$election_name,$position,$party_name,$candidateDescription,$msg);
   
//                         // if($res){
//                         //     header("Location: ../View/Candidate/candidateProfile.php");
//                         // }
//                         // else{
//                         //     header("Location: ../View/Candidate/candidateProfile.php");
//                         // }


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
// }

    public function applyNomination()
    {
        $names = $this->electModel->getUpcomingElections();
        $positions = $this->positionModel->getElectionPositions();
        $parties = $this->partyModel->getElectionParties();

        $this->view('Candidate/applyNomination', ['names' => $names, 'positions' => $positions, 'parties' => $parties]);
    }

    public function nominationSuccessful()
    {
        $this->view('Candidate/nominationSuccessful');
    }

    // public function objections(){
    //     $this->view('Candidate/objections');
    // }

    public function updateProfile()
    {
        $this->view('Candidate/updateProfile');
    }

    public function candidateProfile()
    {

        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{
           
            
            $candidate_id=$_SESSION["UserId"];
            
            
            $res = $this->candidateModel->getCandidateProfile($candidate_id);
            
            $elect= $this->electModel->findelectNameById($res[0]->electionid);
            $position= $this->positionModel->findPositionNameById($res[0]->positionId);
            $party= $this->partyModel->findPartyNameById($res[0]->partyId);
            // var_dump($party);
            // die();
            $this->view('Candidate/candidateProfile', ['res' => $res,'elect' => $elect, 'party' => $party, 'position' => $position]);
            
        }
        echo "<h3> Welcome " . htmlspecialchars($_SESSION["fname"]) . " " . htmlspecialchars($_SESSION["lname"]) . "</h3>";
        // $r=$this->nominateModel->RetrieveAll();
        // $this->view('Candidate/candidateProfile',['r'=>$r]);

    }

    public function objections()
    {
        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{
        $candidate_id = 20;
        // var_dump("A");
        // die();
        $r = $this->nominateModel->getObjection($candidate_id);
        // $r=$this->objectModel->RetrieveAll();
        $this->view('Candidate/objections', ['r' => $r]);
    }
}

    public function respondObjection()
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
        $this->view('Candidate/objections');
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

    public function discussionForum()
    {
        $this->view('Candidate/discussionForum');
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
                'reason' => $_POST['reason'],
            ];

            $this->partyOwnerRequestModel->partyRejected($data);
            redirect('Candidates/partyRequests');
          
        }
        else{
            // $partyRequest=new PartyOwnerRequests();//object creation/instantiation for class object.
            $requests=$this->partyOwnerRequestModel->getPartyRequests($_SESSION["UserId"]);
            // var_dump($requests);
            // exit;
            $this->view('Candidate/partyRequests', ['request' => $requests]);
        }
        
    }
    public function acceptPartyRequest()
    {
        $query = [];
        foreach ($_GET as $key => $value) {
            $query[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $request_id=$query['id'];      
        $this->partyOwnerRequestModel->partyAccepted($request_id);
        // var_dump("hello");
        // exit;
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
             
        $candidate_id=$_SESSION["UserId"];
            // var_dump($candidate_id);
            // exit;
        $res = $this->candidateModel->getCandidateProfile($candidate_id);
        
        $elect= $this->electModel->findelectNameById($res[0]->electionid);
        
        $position= $this->positionModel->findPositionNameById($res[0]->positionId);
        
        $party= $this->partyModel->findPartyNameById($res[0]->partyId);
   
        $this->view('Candidate/updateProfile', ['res' => $res,'elect' => $elect, 'party' => $party, 'position' => $position]);
        // $this->view('Candidate/updateProfile');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'candidateId' => $candidate_id,
                'candidateName' => $_POST['candidateName'],
                'description' => $_POST['description'],
                'vision' => $_POST['vision'],
            ];
            // var_dump($data);
            // exit;
            $this->candidateModel->updateCandidateProfile($data);
            // redirect('Candidates/update_profile');
        }
        // $this->view('Candidate/updateProfile');

        } 
    }

    public function showElectionNames(){
        $names = $this->electModel->getUpcomingElections();
        $this->view('Candidate/applyNomination', ['names' => $names]);
var_dump($names);
exit;
    }

    // public function showImage()
    // {
    //     $image = $_GET['image'];

    //     // Display image
    //     echo '<img src="uploads/' . $image . '">';
    // }

}
