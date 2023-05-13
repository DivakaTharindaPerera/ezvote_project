<?php
class Contact_us extends Controller
{

    public function __construct()
    {
        $this->contactModel = $this->model('ContactUs');
    }


    public function contact_us(){
          
        //        if(!$this->isLoggedIn()){
        //            echo 'log in';
        //        }
        //        else{
        
                // if($this->IsPost()){
                    if(isset($_POST['submit'])){
        
                    $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                    // var_dump($_POST);
                    // $elect_id= $this->nominateModel->getElect_Id($_POST['election_name']);
                    // $party_id= $this->nominateModel->getParty_Id($_POST['party_name']);
                    // $position_id= $this->nominateModel->getPosition_Id($_POST['position']);
        
                    // var_dump($elect_id);
                    // var_dump($party_id);
                    // var_dump($position_id);
        
                    $data=[
                        'firstname'=>trim($_POST['firstname']),
                        'lastname'=>trim($_POST['lastname']),
                        'email'=>trim($_POST['email']),
                        'phoneno'=>trim($_POST['phoneno']),                
                        'organization'=>trim($_POST['organization']),
                        'noofvoters'=>trim($_POST['noofvoters']),
                        'votingstartdate'=>trim($_POST['votingstartdate']),
                        'additionaldetails'=>trim($_POST['additionaldetails']),
        
                        'firstname_err'=>'',
                        'lastname_err'=>'',
                        'email_err'=>'',                                       
                        'organization_err'=>'',
                        'noofvoters_err'=>'',
                        'votingstartdate_err'=>'',
                        'additionaldetails_err'=>''        
                    ];
        
                    //validate data
        
                    if(empty($data['firstname'])){
                        $data['firstname_err']='Please enter fname';
                    }
        
                    if(empty($data['lastname'])){
                        $data['lastname_err']='Please enter lname';
                    }

                    if(empty($data['email'])){
                        $data['email_err']='Please enter email';
                    }

                    if(empty($data['organization'])){
                        $data['organization_err']='Please enter organization name';
                    }
        
                    if(empty($data['noofvoters'])){
                        $data['noofvoters_err']='Please enter number of voters';
                    }
        
                    if(empty($data['votingstartdate'])){
                        $data['votingstartdate_err']='Please enter estimated voting start date';
                    }

            //make sure no errors
         if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['email_err']) && empty($data['organization_err']) && empty($data['noofvoters_err']) && empty($data['votingstartdate_err'])){
                        //validated
                        if($this->contactModel->AddContactUs($data)){
        //                    flash('register_success','You have successfully submitted your objection');
                            redirect('/Candidates/nominationSuccessful');}
                        else{
                            die('Something went wrong');
                        }
                    }else{
                        //load view with errors
                        $this->view('contact_us',$data);
                    }
        

                }
                else {
                    $data = [
        
                        'firstname'=>'',
                        'lastname'=>'',
                        // 'election_name'=>'',
                        // 'position'=>'',
                        // 'checkbox'=>'',
                        // 'party_name'=>'',
                        'profile_picture'=>'',
                        'identity_proof'=>'',
                        'candidateDescription'=>'',
                        'msg'=>'',
        
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


             public function contact_us_II(){
                if(isset($_POST['submit'])){
                    $firstname = trim($_POST['firstname']);
                    $lastname = trim($_POST['lastname']);
                    $email = trim($_POST['email']);
                    $phoneno = trim($_POST['phoneno']);                
                    $organization = trim($_POST['organization']);
                    $noofvoters = trim($_POST['noofvoters']);
                    $votingstartdate = trim($_POST['votingstartdate']);
                    $additionaldetails = trim($_POST['additionaldetails']);

                if(empty($firstname) || empty($lastname) || empty($email) || empty($phoneno) || empty($organization) || empty($noofvoters) || empty($votingstartdate)){
echo "25";
                header('location: contact-us.php?err');
}
}

}


}