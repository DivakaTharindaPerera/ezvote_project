<?php

class Votings extends Controller{
    private $voterModel;
    private $candidateModel;
    private $electionModel;
    private $votingModel;

    public function __construct(){
        $this->voterModel = $this->model('Voter');
        $this->candidateModel = $this->model('Candidate');
        $this->electionModel = $this->model('Election');
        $this->votingModel = $this->model('Voting');
    }

    public function otpVerify(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $otp = trim($_POST['otp']);
            $eid = trim($_POST['eid']);

            $row = $this->votingModel->getVoterByUidAndEid($_SESSION['UserId'], $eid);

            if(password_verify($otp, $row->OTP)){

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
}