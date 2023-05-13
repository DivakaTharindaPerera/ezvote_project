<?php

class Candidates extends Controller
{

    public function __construct()
    {
        $this->nominateModel = $this->model('Nomination');
        $this->objectModel = $this->model('Objection');
        $this->discussionModel = $this->model('discussion');
        $this->candidateModel = $this->model('Candidate');
        $this->electModel = $this->model('Election');
        $this->positionModel = $this->model('electionPositions');
        $this->partyModel = $this->model('Party');
        $this->partyOwnerRequestModel = $this->model('PartyOwnerRequest');
        $this->userModel = $this->model('User');
        $this->voterModel = $this->model('Voter');
        $this->mailModel = $this->model('Email');
        $this->conferenceModel = $this->model('Conference');


  
    }



    // public function objections(){
    //     $this->view('Candidate/objections');
    // }

    public function updateProfile()
    {
        $this->view('Candidate/updateProfile');
    }

    // define a method candidateProfile that accepts $id parameter.
    public function candidateProfile($id)
    {

        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{

            $candidate_id=$id;

            //getCandidateProfile method of the candidateModel object is called with the $candidate_id as an argument
            $res = $this->candidateModel->getCandidateProfile($candidate_id);
            //$res = array

            $elect= $this->electModel->findelectNameById($res[0]->electionid);
            $position= $this->positionModel->findPositionNameById($res[0]->positionId);
            $party= $this->partyModel->findPartyNameById($res[0]->partyId);
            //$party -array with a single element, which is an object of the stdClass class

            $user_id=$_SESSION["UserId"];
            $res2 = $this->candidateModel->getCandidateByUser($user_id);
           
            $res3 = $this->candidateModel->findCandidateByUserIdAndCandidateId($user_id,$candidate_id);
            
            //render a view file Candidate/candidateProfile and passes an array of data to the view
            $this->view('Candidate/candidateProfile', ['res' => $res,'elect' => $elect, 'party' => $party, 'position' => $position, 'res2' => $res2, 'res3' => $res3]);
            
        }
        // echo "<h3>" . htmlspecialchars($_SESSION["fname"]) . " " . htmlspecialchars($_SESSION["lname"]) . "</h3>";
        // $r=$this->nominateModel->RetrieveAll();
        // $this->view('Candidate/candidateProfile',['r'=>$r]);

    }

    //function is defined with the parameters $id and $eid.
    public function objections($id,$eid)
    {
        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{
        $candidate_id=$id;
        $election_id=$eid;
        //findObjectionBycandidateIdAndElectionId method of the $nominateModel object is called with $candidate_id and $election_id as arguments.
        $r = $this->nominateModel->findObjectionBycandidateIdAndElectionId($candidate_id,$election_id);
        
        // render a view file Candidate/objections and passes an array of data to the view, including $r
        $this->view('Candidate/objections', ['r' => $r]);
    }
}

    //function is defined with the parameters $id and $eid.
    public function respondObjection($id,$eid)
    {
        if (!isset($_SESSION["UserId"])) {
            header("Location: " . urlroot . "/View/Login");
            exit;
        }else{        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //$data - associative array(contains key-value pairs for the data)
            $data = [
            //Respond,ObjectionID keys are retrieved from the $_POST superglobal array, which contains form data submitted via POST method
                'Respond' => $_POST['Description'],
                'ObjectionID' => $_POST['ObjectionID'],
                // 'Respond'=>'',
                // 'ElectionID'=>1281,
                // 'CandidateID'=>20,
                // 'VoterID'=>6,
            ];
            $this->nominateModel->respondToObjection($data);
        }
        //redirect to the Candidates/objections page with the $id and $eid parameters included in the URL
        redirect('Candidates/objections/' .$id.'/'.$eid);
    }
    }

    //function is defined with the parameters $id1,$id2 and $id3
    public function createPost($id1,$id2,$id3)
    {

        $voter=$this->voterModel->getVoterByUserIdAndElectionId($_SESSION["UserId"],$id2);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // $data - associative array(contains key-value pairs for the data)
            $data = [
                // id ,name retrieve from the $_POST superglobal array, which contains form data submitted via POST method
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'msg' => $_POST['msg'],
                'elect_id'=>$id2,
                'candidate_id'=>$id3,
                'voter_id'=>$voter->voterId,
            ];

            //call insertPost method of the $discussionModel object

            if ($this->discussionModel->insertPost($data)) {
                //If the insertion is successful, a JSON-encoded response with the key statusCode set to 200 is echoed. 
                echo json_encode(['statusCode' => 200]);
            } else {
                echo json_encode(['statusCode' => 201]);
            }
        }
        // $this->view('Candidate/discussionForum');
    }

    //function is defined with the parameters $id1,$id2
    public function viewPost($id1,$id2)
    {
        
        $data = array(); //array uses to store the retrieved data
        
        //call viewDiscussion method of the $discussionModel object
        $result = $this->discussionModel->viewDiscussion($id1,$id2);
        $data = $result;


        //json_encode function is called to convert the $data array into a JSON string

        $voter=$this->voterModel->findVoterByUserIdAndElectionId($_SESSION["UserId"],$id1);
        $voterDiscussion=$this->discussionModel->viewDiscussionForVoter($id1,$id2,$voter->voterId);
        $idarray=array();
        foreach($voterDiscussion as $voterDiscussion){
            array_push($idarray,$voterDiscussion->id);
        }
        $replies=array();
        foreach($idarray as $id){
            array_push($replies,$this->discussionModel->getReplies($id));
        }
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    //function is defined with the parameters $electionId,$candidate_id
    public function discussionForum($electionId,$candidate_id)
    {
        $user_id=$_SESSION['UserId'];
       
        //call findVoterByUserIdAndElectionId method of the voterModel object
        $result = $this->voterModel->findVoterByUserIdAndElectionId($user_id,$electionId);
   
        //call findCandidateByUserIdAndElectionId method of the candidateModel object
        //It retrieves candidate data based on the user ID and election ID
        $result2 = $this->candidateModel->findCandidateByUserIdAndElectionId($user_id,$electionId);
      
        // render a view file Candidate/discussionForum and passes an array of data to the view, including $result
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

            // $data - associative array(contains key-value pairs for the data)
            $data = [
                'request_id' => $_POST['request_id'],
                'candidate_id' => $_POST['candidate_id'],
                'reason' => $_POST['reason'],
            ];

            //call partyRejected method of the partyOwnerRequestModel object
            $this->partyOwnerRequestModel->partyRejected($data);
            $user=$this->userModel->getUserByUserId($_SESSION['UserId']);

            $subject = "Party Request Rejected";
            $msg = "Your party request is rejected because " . $data['reason'];
                
            // $emailData - associative array(contains key-value pairs for the data)
            $emailData = [
                'email' => $user[0]->Email,
                'subject' => $subject,
                'body' => $msg
                ];
            try {
                //call sendEmail method of the mailModel object
                $this->mailModel->sendEmail($emailData);
            } catch (Exception $e) {
                echo "Message could not be sent. Please try again later.";
            }
            redirect('Candidates/partyRequests');

        }
        // If the request method is not a POST request
        else{

            //call getUserByUserId method of the userModel object
            $res = $this->userModel->getUserByUserId($_SESSION["UserId"]);
                        
            //call getPartyByEmail method of the partyModel object
            $res2 = $this->partyModel->getPartyByEmail($res[0]->Email);

            if(!empty($res2)){
                            
            //call getPartyRequests method of the partyOwnerRequestModel object
            $requests=$this->partyOwnerRequestModel->getPartyRequests($_SESSION["UserId"]);
            // var_dump($requests);
            // exit;
            
            $election=[]; // $election - array

            //iterate through each request and retrieve the associated election data and store them
            foreach ($requests as $row){
                $election_id= $row->election_id;
                
                //call findelectNameById method of the electModel object
                $elect=$this->electModel->findelectNameById($election_id);
                
                //request ID = key and organization name and title = values
                $election[$row->request_id]=$elect[0]->OrganizationName.' '.$elect[0]->Title;
            }

            // render a view file Candidate/partyRequests and passes an array of data to the view, including $request
            $this->view('Candidate/partyRequests', ['request' => $requests, 'electName' => $election]);
            
            // res2 is empty
        }else{
                redirect('pages/dashboard');
            }
        }
    }

    //function is defined with the parameters $request_id,$candidate_id
    public function acceptPartyRequest($request_id,$candidate_id)
    {
        //call getUserByUserId method of the userModel object
        $user=$this->userModel->getUserByUserId($_SESSION['UserId']);

        //call partyAccepted method of the partyOwnerRequestModel object
        $this->partyOwnerRequestModel->partyAccepted($request_id);

        $subject = "Party Request is Accepted";
        $msg = "Your party request is accepted.
                Please log into <a href='" . urlroot . "'>ezvote</a> and apply for the nomination.";
        
        //$emailData - associative array
        $emailData = [
            'email' => $user[0]->Email,
            'subject' => $subject,
            'body' => $msg
        ];

        try {
            //call sendEmail method of the mailModel object
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
             
        
        // var_dump($res);
        //     exit;
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

            $filename = $_FILES["file"]["name"];
            // var_dump($filename2);
            $tempname = $_FILES["file"]["tmp_name"];
            // var_dump($tempname2);
            $folder2 = "../public/img/candidate/proofDocuments/" . $filename;
            move_uploaded_file($tempname, $folder2);
            
            $data = [
                'candidateId' => $_POST['candidateid'],
                'candidateName' => $_POST['candidateName'],
                'profile' => $_POST['profile'],
                'identity' => $_POST['identity'],
                'profilePicture' => $imageName,
                'identityProof' => $filename,
                'description' => $_POST['description'],
                'vision' => $_POST['vision'],
            ];

            //call updateCandidateProfile method of the candidateModel object
            $this->candidateModel->updateCandidateProfile($data);

            $id=intval($data['candidateId']);
            redirect('Candidates/candidateProfile/'.$id);
        }
        // $this->view('Candidate/updateProfile');
        // redirect('Candidates/candidateProfile');
        } 
    }

    public function showElectionNames(){

        //call getUpcomingElections method of the electModel object
        $names = $this->electModel->getUpcomingElections();
            
        // render a view file Candidate/applyNomination and passes an array of data to the view, including $names
        $this->view('Candidate/applyNomination', ['names' => $names]);
    }

    //function is defined with the parameters $election_id,$candidate_id = null
    public function election($election_id,$candidate_id = null)
    {
        if ($this->isLoggedIn()) {
                   
            //call getElectionByElectionId method of the electModel object
            $data_1 = $this->electModel->getElectionByElectionId($election_id);
            $data_2 = $this->electModel->getPositionsByElectionId($election_id);
            $data_3 = $this->electModel->getCandidatesByElectionId($election_id);
            // $data_4 = $this->conferenceModel->getConferencesByElectionID($election_id);
            // // var_dump($data_4);
            // // exit;
            // foreach ($data_4 as $conference){
            //     if($conference->ParticipantsC==1){
            //         $data_5[]=$conference;
            //     };
            // }

            // retrieve the candidate ID associated with the current user and the specified election
            $data_6 = $this->candidateModel->findCandidateByUserIdAndElectionId($_SESSION['UserId'],$election_id);
            $candidate=$data_6[0]->candidateId;
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_id = $_SESSION['UserId'];

                //call getVoterByUserId method of the voterModel object
                $voter_id = $this->voterModel->getVoterByUserId($user_id)->voterId;
                $candidate_id = $_POST['CandidateID'];
                
                //$data - associative array
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

                //call AddObjection method of the objModel object
                $this->objModel->AddObjection($data);
                redirect('candidates/election/' . $election_id);

                //If request method is not POST
            } else {
                $user_id = $_SESSION['UserId'];

                //call getVoterByUserId method of the voterModel object
                $voter_id = $this->voterModel->getVoterByUserId($user_id)->voterId;
                $result = $this->partyOwnerRequestModel->getPartyRequestsByElectionAndUser($election_id,$_SESSION['UserId']);
                
                $this->view('Candidate/viewCandidateElection', [
                    'election' => $data_1,
                    'positions' => $data_2,
                    'candidates' => $data_3,
                    'result' => $result,
                    'voter_id' => $voter_id,
                    'candidate_id'=>$candidate,
                    // 'conferences' => $data_5,
                ]);
            }
        } else {
            $this->view('login');
        }
    }
}
