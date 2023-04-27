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

        
    }



    //**************************************************************************************************************************** */
    public function nomination_apply()
    {

        //        if(!$this->isLoggedIn()){
        //            echo 'log in';
        //        }
        //        else{

        // if($this->IsPost()){
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
                'election_err' => '',
                'position_err' => '',
                'party_err' => '',
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

            if (empty($data['ElectionID'])) {
                $data['election_err'] = 'Please enter election name';
            }

            if (empty($data['ID'])) {
                $data['position_err'] = 'Please enter position you wish to contest';
            }

            if (empty($data['PartyId'])) {
                $data['party_err'] = 'Please enter party name you wish to contest';
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
            if (empty($data['fname_err']) && empty($data['lname_err']) && empty($data['description_err']) && empty($data['msg_err'])) {
                //validated
                if ($this->nominateModel->AddNomination($data)) {
                    redirect('/Candidates/nominationSuccessful');
                } else {
                    die('Something went wrong');
                }
            } else {
                //load view with errors
                $this->view('Candidate/applyNomination', $data);
            }

            /*****************************************************************************/




            // // Validation checks
            // if (empty($imageName)) {
            //   return "Image name is required";
            // }
            // if ($imageSize > 5000000) {
            //   return "Image size must be less than 5MB";
            // }

            // // Get image extension
            // $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            // // Generate unique file name
            // $newImageName = uniqid() . '.' . $imageExtension;
            // // $folder1 = urlroot."/img/welcome/" . $imageName;

            // // Move image to uploads directory
            // move_uploaded_file($imageTmpName, urlroot.'/img/uploadedImages/' . $newImageName);

            // // Redirect to view page
            // // header('Location: view.php?image=' . $newImageName);
            // // exit();





            // $validatedData = [
            //     'firstname' => $data['firstname'],
            //     'lastname' => $data['lastname'],
            //     'election_name' => $data['election_name'],
            //     'position' => $data['position'],
            //     'party_name' => $data['party_name'],
            //     'profile_picture' => $filename,
            //     'identity_proof' => $filename2,
            //     'candidateDescription' => $data['candidateDescription'],
            //     'msg' => $data['msg']
            // ];

            /****************************************************************************************************************/
            //make sure no errors
            // if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['election_name_err']) && empty($data['position_err'])
            // && empty($data['party_name_err']) && empty($data['profile_picture_err']) && empty($data['identity_proof_err'])&& empty($data['party_description_err'])   
            // && empty($data['msg_err'])){
            //     //validated
            //     if($this->nominateModel->AddNomination($validatedData)){
            //             // echo "2";
            //             // redirect('candidates/nominationSuccessful');
            //             redirect('/Candidates/nominationSuccessful');
            //     }
            //     // else{
            //     //     die('Something went wrong');
            //     // }
            // }else{
            //     //load view with errors
            //     // echo "2";
            //     $this->view('Candidate/applyNomination',$data);
            // }
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

    public function nomination_app()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                // 'objectionID'=>uniqid('obj',true),
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'candidateDescription' => trim($_POST['candidateDescription']),
                'msg' => trim($_POST['msg']),
                'ElectionID' => 1281,
                'ID' => 41,
                'PartyId' => 50,
            ];
            $this->nominateModel->AddNomination($data);
        }
        $this->view('Candidate/candidateProfile');
    }

    public function update_candidate_profile()
    {

        //        if(!$this->isLoggedIn()){
        //            echo 'log in';
        //        }
        //        else{

        // if($this->IsPost()){

        // $nominationID = uniqid('obj',true);
        $candidateName = $_POST['candidateName'];
        $candidateEmail = $_POST['candidateEmail'];
        $position = $_POST['position'];
        $party_name = $_POST['party_name'];
        // // 'profile_picture'=>$_FILES['imgfile'],
        // // 'identity_proof'=>$_FILES['file'],
        $description = $_POST['description'];
        $vision = $_POST['vision'];
        if (isset($_POST['update'])) {

            $res = $this->nominateModel->updateCandidateProfile($nominationID, $firstname, $lastname, $election_name, $position, $party_name, $candidateDescription, $msg);

            if ($res) {
                header("Location: ../View/Candidate/candidateProfile.php");
            } else {
                header("Location: ../View/Candidate/candidateProfile.php");
            }
        }
    }

    public function applyNomination()
    {
        $this->view('Candidate/applyNomination');
    }

    public function nominationSuccessful()
    {
        $this->view('Candidate/nominationSuccessful');
    }

    // public function objections(){
    //     $this->view('Candidate/objections');
    // }

    // public function candidateProfile()
    // {
    //     $this->view('Candidate/candidateProfile');
    // }

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
        $candidate_id = 20;
        // var_dump("A");
        // die();
        $r = $this->nominateModel->getObjection($candidate_id);
        // $r=$this->objectModel->RetrieveAll();
        $this->view('Candidate/objections', ['r' => $r]);
    }

    public function respondObjection()
    {
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

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                // 'Respond'=>$_POST['Description'],
                'candidateId' => $_POST['candidateId'],
                'candidateName' => $_POST['candidateName'],
                'candidateEmail' => $_POST['candidateEmail'],
                // 'imgfile'=>$_POST['imgfile'],
                // 'file'=>$_POST['file'],
                'description' => $_POST['description'],
                'vision' => $_POST['vision'],
            ];
            $this->nominateModel->updateCandidateProfile($data);
        }
        $this->view('Candidates/objections');
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
        // if($_SERVER['REQUEST_METHOD']==='POST'){

        //     $data=[
        //         'name'=>$_POST['name'],
        //         'msg'=>$_POST['msg'],
        //     ];
        $result = $this->discussionModel->viewDiscussion();
        $data = $result;
        // exit;
        // while($row = $result->fetchAll()){
        //     array_push($data, $row);
        //     array_push($data);
        // }

        echo json_encode($data);
        // exit();
        // }
        // $this->view('Candidate/discussionForum');
    }


    // public function candidateProfile($id) {
    //     $row = $this->model->getSingleRow($id);
    //     // pass the row to the view
    //     $this->view->render('row', $row);
    // }

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


    public function election_results()
    {
        $this->view('Candidate/election_results');
    }
    public function update_profile()
    {
        $this->view('Candidate/updateProfile');
    }

    /**********************upload image************************************************* */


    //   public function storeImage() {
    //     $imageName = $_FILES['image']['name'];
    //     $imageTmpName = $_FILES['image']['tmp_name'];
    //     $imageType = $_FILES['image']['type'];
    //     $imageSize = $_FILES['image']['size'];

    //     // Validation checks
    //     if (empty($imageName)) {
    //       return "Image name is required";
    //     }
    //     if ($imageSize > 5000000) {
    //       return "Image size must be less than 5MB";
    //     }

    //     // Get image extension
    //     $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    //     // Generate unique file name
    //     $newImageName = uniqid() . '.' . $imageExtension;

    //     // Move image to uploads directory
    //     move_uploaded_file($imageTmpName, 'uploads/' . $newImageName);

    //     // Redirect to view page
    //     header('Location: view.php?image=' . $newImageName);
    //     exit();
    //   }



    public function showImage()
    {
        $image = $_GET['image'];

        // Display image
        echo '<img src="uploads/' . $image . '">';
    }

    /***************************************view image(above)************************************************ */




    // public function discussion_forum(){

    //     //        if(!$this->isLoggedIn()){
    //     //            echo 'log in';
    //     //        }
    //     //        else{

    //             // if($this->IsPost()){
    //                 if(isset($_POST['save'])){

    //                 $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
    //                 $data=[

    //                     /************************************************/
    //                     'nominationID'=>uniqid('obj',true),
    //                     'firstname'=>trim($_POST['firstname']),
    //                     'lastname'=>trim($_POST['lastname']),
    //                     'election_name'=>trim($_POST['election_name']),
    //                     'position'=>trim($_POST['position']),                
    //                     'party_name'=>trim($_POST['party_name']),
    //                     // 'profile_picture'=>$_FILES['imgfile'],
    //                     // 'identity_proof'=>$_FILES['file'],
    //                     'candidateDescription'=>trim($_POST['candidateDescription']),
    //                     'msg'=>trim($_POST['msg']),

    //                     'firstname_err'=>'',
    //                     'lastname_err'=>'',
    //                     'election_name_err'=>'',
    //                     'position_err'=>'',                
    //                     'party_name_err'=>'',
    //                     'profile_picture_err' =>'',
    //                     'candidateDescription_err'=>'',
    //                     'msg_err'=>''

    //                 ];
    //         //Check whether all the fields are filled properly
    //         if(!$_POST['firstname'] && !$_POST['lastname'] && !$_POST['election_name'] && !$_POST['position'] && !$_POST['party_name'] && !$_POST['imgfile'] && !$_POST['file'] && !$_POST['candidateDescription'] && !$_POST['msg']){
    //                     $data['firstname_err'] =  "*This field is Required";
    //                     $data['lastname_err'] = "*This field is Required";
    //                     $data['election_name_err'] = "*This field is Required";
    //                     $data['position_err'] = "*This field is Required";
    //                     $data['party_name_err'] = "*This field is Required";
    //                     $data['profile_picture_err'] = "*This field is Required";
    //                     $data['identity_proof_err'] = "*This field is Required";
    //                     $data['candidateDescription_err'] = "*This field is Required";
    //                     $data['msg_err'] = "*This field is Required";
    //                 }

    //     /*****************************************************************************/

    //                 $filename = $_FILES["imgfile"]["name"];
    //                 $tempname = $_FILES["imgfile"]["tmp_name"];
    //                 $folder = urlroot."/img/welcome/" . $filename;
    //                 move_uploaded_file($tempname, $folder);

    //                 $filename2 = $_FILES["file"]["name"];
    //                 $tempname2 = $_FILES["file"]["tmp_name"];
    //                 $folder2 = urlroot."/img/welcome/" . $filename2;
    //                 move_uploaded_file($tempname2, $folder2);

    //     $validatedData = [
    //         'firstname' => $data['firstname'],
    //         'lastname' => $data['lastname'],
    //         'election_name' => $data['election_name'],
    //         'position' => $data['position'],
    //         'party_name' => $data['party_name'],
    //         'profile_picture' => $filename,
    //         'identity_proof' => $filename2,
    //         'candidateDescription' => $data['candidateDescription'],
    //         'msg' => $data['msg']
    //     ];

    //     /****************************************************************************************************************/
    //                 //make sure no errors
    //                 if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['election_name_err']) && empty($data['position_err'])
    //                 && empty($data['party_name_err']) && empty($data['profile_picture_err']) && empty($data['identity_proof_err'])&& empty($data['party_description_err'])   
    //                 && empty($data['msg_err'])){
    //                     //validated
    //                     if($this->nominateModel->AddNomination($validatedData)){
    //                             // echo "2";
    //                             // redirect('candidates/nominationSuccessful');
    //                             redirect('/Candidates/nominationSuccessful');
    //                     }
    //                     // else{
    //                     //     die('Something went wrong');
    //                     // }
    //                 }else{
    //                     //load view with errors
    //                     // echo "2";
    //                     $this->view('Candidate/applyNomination',$data);
    //                 }
    //             }
    //             else {
    //                 $data = [

    //                     'firstname'=>'',
    //                     'lastname'=>'',
    //                     'election_name'=>'',
    //                     'position'=>'',
    //                     'checkbox'=>'',
    //                     'party_name'=>'',
    //                     'profile_picture'=>'',
    //                     'identity_proof'=>'',
    //                     'candidateDescription'=>'',
    //                     'msg'=>'',

    //                     'firstname_err'=>'',
    //                     'lastname_err'=>'',
    //                     'election_name_err'=>'',
    //                     'position_err'=>'',
    //                     'party_name_err'=>'',
    //                     'profile_picture_err'=>'',
    //                     'identity_proof_err'=>'',
    //                     'party_description_err'=>'',
    //                     'candidateDescription_err'=>'',
    //                     'msg_err'=>''
    //                 ];
    //                 // echo "2";
    //                 $this->view('Candidate/nomination_apply', $data);

    //             }
    //         }

    public function viewprofile($candidateId)
    {
        $candidateData = Nomination::getById($candidateId);
        $view = new View('candidate/profile');
        $view->setData('candidateData', $candidateData);
        $view->render();
    }
}
