<?php
class Candidates extends Controller
{

    public function __construct()
    {
        $this->nominateModel = $this->model('Nomination');
    }



//**************************************************************************************************************************** */

    public function nomination_apply(){
        
//        if(!$this->isLoggedIn()){
//            echo 'log in';
//        }
//        else{

        // if($this->IsPost()){
            if(isset($_POST['save'])){

            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data=[

                /************************************************/
                'nominationID'=>uniqid('obj',true),
                'firstname'=>trim($_POST['firstname']),
                'lastname'=>trim($_POST['lastname']),
                'election_name'=>trim($_POST['election_name']),
                'position'=>trim($_POST['position']),                
                'party_name'=>trim($_POST['party_name']),
                // 'profile_picture'=>$_FILES['imgfile'],
                // 'identity_proof'=>$_FILES['file'],
                'candidateDescription'=>trim($_POST['candidateDescription']),
                'msg'=>trim($_POST['msg']),

                'firstname_err'=>'',
                'lastname_err'=>'',
                'election_name_err'=>'',
                'position_err'=>'',                
                'party_name_err'=>'',
                'profile_picture_err' =>'',
                'candidateDescription_err'=>'',
                'msg_err'=>''

            ];
    //Check whether all the fields are filled properly
    if(!$_POST['firstname'] && !$_POST['lastname'] && !$_POST['election_name'] && !$_POST['position'] && !$_POST['party_name'] && !$_POST['imgfile'] && !$_POST['file'] && !$_POST['candidateDescription'] && !$_POST['msg']){
                $data['firstname_err'] =  "*This field is Required";
                $data['lastname_err'] = "*This field is Required";
                $data['election_name_err'] = "*This field is Required";
                $data['position_err'] = "*This field is Required";
                $data['party_name_err'] = "*This field is Required";
                $data['profile_picture_err'] = "*This field is Required";
                $data['identity_proof_err'] = "*This field is Required";
                $data['candidateDescription_err'] = "*This field is Required";
                $data['msg_err'] = "*This field is Required";
            }

/*****************************************************************************/

                    $filename = $_FILES["imgfile"]["name"];
                    $tempname = $_FILES["imgfile"]["tmp_name"];
                    $folder = urlroot."/img/welcome/" . $filename;
                    move_uploaded_file($tempname, $folder);
        
                    $filename2 = $_FILES["file"]["name"];
                    $tempname2 = $_FILES["file"]["tmp_name"];
                    $folder2 = urlroot."/img/welcome/" . $filename2;
                    move_uploaded_file($tempname2, $folder2);
            // $imageName = $_FILES['image']['name'];
            // $imageTmpName = $_FILES['image']['tmp_name'];
            // $imageType = $_FILES['image']['type'];
            // $imageSize = $_FILES['image']['size'];
            
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


           
            // $filename2 = $_FILES["file"]["name"];
            // $tempname2 = $_FILES["file"]["tmp_name"];
            // $folder2 = urlroot."/img/welcome/" . $filename2;
            // move_uploaded_file($tempname2, $folder2);

$validatedData = [
    'firstname' => $data['firstname'],
    'lastname' => $data['lastname'],
    'election_name' => $data['election_name'],
    'position' => $data['position'],
    'party_name' => $data['party_name'],
    'profile_picture' => $filename,
    'identity_proof' => $filename2,
    'candidateDescription' => $data['candidateDescription'],
    'msg' => $data['msg']
];

/****************************************************************************************************************/
            //make sure no errors
            if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['election_name_err']) && empty($data['position_err'])
            && empty($data['party_name_err']) && empty($data['profile_picture_err']) && empty($data['identity_proof_err'])&& empty($data['party_description_err'])   
            && empty($data['msg_err'])){
                //validated
                if($this->nominateModel->AddNomination($validatedData)){
                        // echo "2";
                        // redirect('candidates/nominationSuccessful');
                        redirect('/Candidates/nominationSuccessful');
                }
                // else{
                //     die('Something went wrong');
                // }
            }else{
                //load view with errors
                // echo "2";
                $this->view('Candidate/applyNomination',$data);
            }
        }
        else {
            $data = [

                'firstname'=>'',
                'lastname'=>'',
                'election_name'=>'',
                'position'=>'',
                'checkbox'=>'',
                'party_name'=>'',
                'profile_picture'=>'',
                'identity_proof'=>'',
                'candidateDescription'=>'',
                'msg'=>'',

                'firstname_err'=>'',
                'lastname_err'=>'',
                'election_name_err'=>'',
                'position_err'=>'',
                'party_name_err'=>'',
                'profile_picture_err'=>'',
                'identity_proof_err'=>'',
                'party_description_err'=>'',
                'candidateDescription_err'=>'',
                'msg_err'=>''
            ];
            // echo "2";
            $this->view('Candidate/nomination_apply', $data);

        }
    }

    public function update_candidate_profile(){
        
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
                        if(isset($_POST['update'])){

                        $res = $this->nominateModel->updateCandidateProfile($nominationID,$firstname,$lastname,$election_name,$position,$party_name,$candidateDescription,$msg);
   
                        if($res){
                            header("Location: ../View/Candidate/candidateProfile.php");
                        }
                        else{
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

    public function objections(){
        $this->view('Candidate/objections');
    }

    // public function candidateProfile()
    // {
    //     $this->view('Candidate/candidateProfile');
    // }

    public function candidateProfile()
    {
        $r=$this->nominateModel->RetrieveAll();
        $this->view('Candidate/candidateProfile',['r'=>$r]);
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



  public function showImage() {
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

}