<?php

class Votings extends Controller{
    private $voterModel;
    private $candidateModel;
    private $electionModel;
    private $votingModel;
    private $positionModel;
    private $partyModel;
    private $encryptModel;
    private $voteModel;

    public function __construct(){
        $this->voterModel = $this->model('Voter');
        $this->candidateModel = $this->model('Candidate');
        $this->electionModel = $this->model('Election');
        $this->votingModel = $this->model('Voting');
        $this->positionModel = $this->model('electionPositions');
        $this->partyModel = $this->model('Party');
        $this->encryptModel = $this->model('userEncrypt');
        $this->voteModel = $this->model('Vote');
    }

    public function otpVerify(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $otp = trim($_POST['otp']);
            $eid = trim($_POST['eid']);

            $row = $this->votingModel->getVoterByUidAndEid($_SESSION['UserId'], $eid);
            $candidateRow = $this->candidateModel->getCandidatesByElectionId($eid);
            $positionRow = $this->positionModel->getElectionPositionByElectionId($eid);

            $electionRow = $this->electionModel->getElectionByElectionId($eid);
            $partyRow = $this->partyModel->getPartiesByElectionId($eid);

            $voterRow = $this->voterModel->getVoterByUserIdAndElectionId($_SESSION['UserId'], $eid);

            $voteData = [
                'vid' => $row->voterId,
                'eid' => $eid,
                'candidates' => $candidateRow,
                'positions' => $positionRow,
                'election' => $electionRow,
                'parties' => $partyRow,
                'voter' => $voterRow
            ];

            if(password_verify($otp, $row->OTP)){
                $this->view('Voter/votingBallot', $voteData);
            }else{
                $data = [
                    'error' => "Invalid OTP. Try again.",
                    'eid' => $eid,
                    'email' => trim($_POST['email'])
                ];
                $this->view('Voter/otpVerify', $data);
            }

        }
    }

    public function otpVerifyPage($eid){
        $data = [
            'eid' => $eid,
            'email' => $_SESSION['email']
        ];

        if(!$this->votingModel->checkForVoter($_SESSION['UserId'],$data['eid'])){
            redirect('Pages/dashboard');
        }else{
            $this->view('Voter/otpVerify', $data);
        }
    }
    public function saveVotes(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $cCount = trim($_POST['cCount']);
            $eid = trim($_POST['electionId']);
            $vid = trim($_POST['voterId']);

            $key = openssl_random_pseudo_bytes(32);
            $iv = openssl_random_pseudo_bytes(16);

            $this->encryptModel->storeKey($vid, $key, $iv);


            for($i = 1; $i <= $cCount; $i++){
                $cid = trim($_POST['candidateId'.$i]);
                $pid = $this->positionModel->getPositionIdByCandidateId($cid);
                $candidate = $this->encrypt($cid, $key, $iv);

                if($this->voteModel->saveVote($vid, $candidate, $pid)){
                    continue;
                }else{ 
                    echo "Something went wrong";
                    return;
                }
            }

            $this->votingModel->castVote($vid);

            redirect('Votings/savedVotes'.$eid);
        }
    }

    public function encrypt($data,$key,$iv){
        $encryptedData = openssl_encrypt($data, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        $encryptedData = base64_encode($encryptedData);
        return $encryptedData;
    }

    public function savedVotes($eid){
        $voter = $this->voterModel->getVoterByUserIdAndElectionId($_SESSION['UserId'], $eid);
        
    }
}