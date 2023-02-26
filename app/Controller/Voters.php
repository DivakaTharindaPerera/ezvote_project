<?php
class Voters extends Controller
{

    public function __construct()
    {
        $this->objModel = $this->model('Objection');
        $this->elecModel=$this->model('Election');
    }
    public function submitObjections(){
//        if(!$this->isLoggedIn()){
//            echo 'log in';
//        }
//        else{

        if($this->IsPost()){
//            $this->objModel->setSubject($_POST['Subject']);
//            $this->objModel->setDescription($_POST['Description']);
//            $this->objModel->AddObjection();
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data=[
                'objectionID'=>uniqid('obj',true),
                'Subject'=>trim($_POST['Subject']),
                'Description'=>trim($_POST['Description']),
                'Respond'=>'',
                'Action'=>'',
                'ElectionID'=>1251,
                'CandidateID'=>'can01',
                'VoterID'=>48,
                'SubjectError'=>'',
                'DescriptionError'=>''
            ];
            //validate data
            if(empty($data['Subject'])){
                $data['Subject_err']='Please enter a subject';
            }
            if(empty($data['Description'])){
                $data['Description_err']='Please enter a description';
            }
            //make sure no errors
            if(empty($data['Subject_err']) && empty($data['Description_err'])){
                //validated
                if($this->objModel->AddObjection($data)){
//                    flash('register_success','You have successfully submitted your objection');
                    redirect('voters/election');}
                else{
                    die('Something went wrong');
                }
            }else{
                //load view with errors
                $this->view('Voters/submitObjections',$data);
            }

        }
        else {
            $data = [
                'Subject' => '',
                'Description' => ''
            ];
            $this->view('voters/submitObjections', $data);

        }
    }

    public function election($id){
        $data=$this->elecModel->getElectionByElectionId($id);
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $data=[
                'objectionID'=>uniqid('obj',true),
                'Subject'=>$_POST['Subject'],
                'Description'=>$_POST['Description'],
                'Respond'=>'',
                'Action'=>'',
                'ElectionID'=>1251,
                'CandidateID'=>'can01',
                'VoterID'=>48,
            ];
            $this->objModel->AddObjection($data);
        }
        $this->view('Voter/viewElection',[
            'data'=>$data
        ]);
    }

    public function viewObjections($candidate_id){
        $r=$this->objModel->RetrieveAll();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id=$_POST['id'];
            $this->objModel->DeleteObjection($id);
            $this->view('Voter/viewObjections',['r'=>$r]);
        }
        $this->view('Voter/viewObjections',['r'=>$r]);
    }

    public function vote($id)
    {

        $data=$this->elecModel->getElectionByElectionId($id);
//        $data_2=$this->elecModel->getPositionsByElectionId($id);
//        print_r($data_2);
//        exit();
        $this->view('Voter/votingBallot',[
            'data'=>$data
//            'positions'=>$data_2
        ]);
    }

    public function summary($id)
    {
        $data=$this->elecModel->getElectionByElectionId($id);
       $this->view('Voter/electionSummary',[
              'data'=>$data
       ]);
    }

}