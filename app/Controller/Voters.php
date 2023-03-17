<?php
class Voters extends Controller
{

    public function __construct()
    {
        $this->objModel = $this->model('Objection');
        $this->elecModel=$this->model('Election');
        $this->voterModel=$this->model('Voter');
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

    public function election($election_id,$candidate_id=null){
        if($this->isLoggedIn()){
            $data_1=$this->elecModel->getElectionByElectionId($election_id);
            $data_2=$this->elecModel->getPositionsByElectionId($election_id);
            $data_3=$this->elecModel->getCandidatesByElectionId($election_id);
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $user_id=$_SESSION['UserId'];
                $voter_id=$this->voterModel->getVoterByUserId($user_id)->voterId;
                $candidate_id=$_POST['CandidateID'];
                $data=[
                    'objectionID'=>uniqid('obj',true),
                    'Subject'=>$_POST['Subject'],
                    'Description'=>$_POST['Description'],
                    'Respond'=>'',
                    'Action'=>'',
                    'ElectionID'=>$election_id,
                    'CandidateID'=>$candidate_id,
                    'VoterID'=>$voter_id
                ];
                $this->objModel->AddObjection($data);
                redirect('voters/election/'.$election_id);
            }
            else {
                $this->view('Voter/viewElection', [
                    'election' => $data_1,
                    'positions' => $data_2,
                    'candidates' => $data_3,
                ]);
            }
        }
        else{
            $this->view('login');
        }

    }

    public function viewObjections($candidate_id,$election_id){
//        $r=$this->objModel->RetrieveAll();
        $data_1=$this->objModel->showObjectionsByElectionAndCandidateId($election_id,$candidate_id);
        $data_2=$this->objModel->getCandidateName($candidate_id);
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id=$_POST['id'];
            $this->objModel->DeleteObjection($id);
//            $this->view('Voter/viewObjections',['r'=>$r]);
        }
        $this->view('Voter/viewObjections',[
//            'r'=>$r,
            'objections'=>$data_1,
            'candidate'=>$data_2
        ]);
    }

    public function vote($id=null,$candidate_id=null)
    {
        $data_1=$this->elecModel->getElectionByElectionId($id);
        $data_2=$this->elecModel->getPositionsByElectionId($id);
        $data_3=$this->elecModel->getCandidatesByElectionId($id);
//        $data_4=$this->voterModel->temporaryVoting();
        $this->view('Voter/votingBallot',[
            'election'=>$data_1,
            'positions'=>$data_2,
            'candidates'=>$data_3,
            'id'=>$id
        ]);
    }

    public function summary($id)
    {
        $data_1=$this->elecModel->getElectionByElectionId($id);
//        $data_2=$this->elecModel->getWinnersDetails($id);
//        print_r($data_2);
//        exit();
//        $i=0;
//        foreach ($data_2 as $winner){
//            $candidateId=$winner->candidateID;
////            echo $candidateId;
////            exit();
//            $data_3=$this->elecModel->getWinnersNames($candidateId);
//            $i=$i+1;
//        }
       $this->view('Voter/electionSummary',[
           'election'=>$data_1,
//           'winners'=>$data_2,
//           'party'=>$data_3
       ]);
    }
     public function temporaryVotes(){
        $data_1=$this->voterModel->temporaryVoting();
        $this->view('Voter/temporaryVotes',[
            'votes'=>$data_1
        ]);
     }

}