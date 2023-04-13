<?php

class Votings extends Controller{
    private $voterModel;
    private $candidateModel;
    private $electionModel;
    private $votingModel;
    private $positionModel;
    private $partyModel;

    public function __construct(){
        $this->voterModel = $this->model('Voter');
        $this->candidateModel = $this->model('Candidate');
        $this->electionModel = $this->model('Election');
        $this->votingModel = $this->model('Voting');
        $this->positionModel = $this->model('electionPositions');
        $this->partyModel = $this->model('Party');
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

            $voterRow = $this->voterModel->findRegVoterByUserIdAndElectionId($_SESSION['UserId'], $eid);

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
}