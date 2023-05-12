<?php

class Votings extends Controller
{
    private $voterModel;
    private $candidateModel;
    private $electionModel;
    private $votingModel;
    private $positionModel;
    private $partyModel;
    private $encryptModel;
    private $voteModel;

    public function __construct()
    {
        $this->voterModel = $this->model('Voter');
        $this->candidateModel = $this->model('Candidate');
        $this->electionModel = $this->model('Election');
        $this->votingModel = $this->model('Voting');
        $this->positionModel = $this->model('electionPositions');
        $this->partyModel = $this->model('Party');
        $this->encryptModel = $this->model('userEncrypt');
        $this->voteModel = $this->model('Vote');
        $this->userModel=$this->model('User');
    }

    public function otpVerify()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $otp = trim($_POST['otp']);
            $eid = trim($_POST['eid']);

            $row = $this->votingModel->getVoterByUidAndEid($_SESSION['UserId'], $eid);
            $candidateRow = $this->candidateModel->getCandidatesByElectionId($eid);
            $positionRow = $this->positionModel->getElectionPositionByElectionId($eid);

            $electionRow = $this->electionModel->getElectionByElectionId($eid);
            $partyRow = $this->partyModel->getPartiesByElectionId($eid);

            $voterRow = $this->voterModel->getVoterByUserIdAndElectionId($_SESSION['UserId'], $eid);
            $users=$this->userModel->getUsers();

            $voteData = [
                'vid' => $row->voterId,
                'eid' => $eid,
                'candidates' => $candidateRow,
                'positions' => $positionRow,
                'election' => $electionRow,
                'parties' => $partyRow,
                'voter' => $voterRow,
                'stat' => 0,
                'users'=>$users
            ];

            if($electionRow->StatVisibality == 1){
                $voteData['stat'] = 1;
            }

            if (password_verify($otp, $row->OTP)) {
                $this->view('Voter/votingBallot', $voteData);
            } else {
                $data = [
                    'error' => "Invalid OTP. Try again.",
                    'eid' => $eid,
                    'email' => trim($_POST['email'])
                ];
                $this->view('Voter/otpVerify', $data);
            }
        }
    }

    public function otpVerifyPage($eid)
    {
        $data = [
            'eid' => $eid,
            'email' => $_SESSION['email']
        ];

        if (!$this->votingModel->checkForVoter($_SESSION['UserId'], $data['eid'])) {
            redirect('Pages/dashboard');
        } else {
            $this->view('Voter/otpVerify', $data);
        }
    }
    public function saveVotes()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $cCount = trim($_POST['cCount']);
            $eid = trim($_POST['electionId']);
            $vid = trim($_POST['voterId']);

            $randomBytes = openssl_random_pseudo_bytes(32);
            $randomIv = openssl_random_pseudo_bytes(16);

            $key = '';
            for ($i = 0; $i < 16; $i++) {
                $key .= ord($randomBytes[$i]) % 10;
            }

            $iv = '';
            for ($i = 0; $i < 16; $i++) {
                $iv .= ord($randomIv[$i]) % 10;
            }


            try {
                $abtKey = $this->encryptModel->storeKey($vid, $key, $iv);
                if ($abtKey == true) {
                    echo "Key stored";
                } else {
                    die($abtKey);
                }


                for ($i = 1; $i <= $cCount; $i++) {
                    $cid = trim($_POST['candidate' . $i]);
                    $pid = $this->positionModel->getPositionIdByCandidateId($cid)->positionId;
                    $candidate = $this->encrypt($cid, $key, $iv);

                    if ($this->voteModel->saveVote($vid, $candidate, $pid)) {
                        continue;
                    } else {
                        echo "Something went wrong";
                        return;
                    }
                }

                $this->votingModel->castVote($vid);

                redirect('Votings/savedVotes/' . $eid);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function savedVotes($eid)
    {
        if ($this->votingModel->checkForVoter($_SESSION['UserId'], $eid) && $this->votingModel->alreadyVoted($_SESSION['UserId'],$eid) ){
            $candidateArray = [];
            $candidateRowArray = [];

            $voter = $this->voterModel->getVoterByUserIdAndElectionId($_SESSION['UserId'], $eid);
            $encryption = $this->encryptModel->getKeyAndIv($voter->voterId);

            $votes = $this->voteModel->retrieveVotes($voter->voterId);

            foreach ($votes as $vote) {
                array_push($candidateArray, $this->decrypt($vote->candidate, $encryption->Key, $encryption->Iv));
            }

            foreach ($candidateArray as $candidate) {
                array_push($candidateRowArray, $this->candidateModel->getCandidateByCandidateId($candidate));
            }

            $data = [
                'candidates' => $candidateRowArray,
                'election' => $this->electionModel->getElectionByElectionId($eid),
                'position' => $this->positionModel->getElectionPositionByElectionId($eid)

            ];

            $this->view('Voter/votingSuccess', $data);
        }else{
            redirect('Pages/dashboard');
        }
    }

    public function encrypt($data, $key, $iv)
    {
        $encryptedData = openssl_encrypt($data, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        $encryptedData = base64_encode($encryptedData);
        return $encryptedData;
    }

    public function decrypt($data, $key, $iv)
    {
        $decryptedData = base64_decode($data);
        $decryptedData = openssl_decrypt($decryptedData, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }


    //utility function
    //will return an associative array with candidateId as key and count of votes as value
    public function calculateVotes($eid)
    {
        $candidates = array();
        $voters = $this->voterModel->getVotersByElectionId($eid);
        $candidateRows = $this->candidateModel->getCandidatesByElectionId($eid);
        foreach ($candidateRows as $candidateRow) {
            $candidates[$candidateRow->candidateId] = 0;
        }
        foreach ($voters as $voter) {
            // echo $voter->voterId."<br>";
            $encryption = $this->encryptModel->getKeyAndIv($voter->voterId);
            $votes = $this->voteModel->retrieveVotes($voter->voterId);
            foreach ($votes as $vote) {
                $candidate = $this->decrypt($vote->candidate, $encryption->Key, $encryption->Iv);
                // echo $candidate."<br>";
                if ($this->verifyCandidate($eid, $candidate)) {
                    $candidates[$candidate] += $voter->value;
                }
            }
        }
        // // print candidates

        // $keys = array_keys($candidates);

        // echo "Candidates : Votes <br>";
        // foreach($keys as $key){
        //     echo $key . " : " . $candidates[$key] . "<br>";
        // }

        return $candidates;
    }

    public function verifyCandidate($eid, $cid)
    {
        $candidate = $this->candidateModel->getCandidateByCandidateId($cid);
        $election = $this->electionModel->getElectionByElectionId($eid);
        if ($election->ElectionId == $candidate->electionid) {
            return true;
        } else {
            return false;
        }
    }


    public function inspectMyElection($eid){
        $data =[];
        $election = $this->electionModel->getElectionByElectionId($eid);
        $voters = $this->voterModel->getVotersByElectionId($eid);
        $candidates = $this->candidateModel->getCandidatesByElectionId($eid);
        $positions = $this->positionModel->getElectionPositionByElectionId($eid);
        if($election->Supervisor == $_SESSION['UserId']){
            $candidatesWithVotes = $this->calculateVotes($eid);
            $data=[
                'election'=>$election,
                'voters'=>$voters,
                'candidates'=>$candidates,
                'positions' => $positions,
                'votes' => $candidatesWithVotes
            ];

            $this->view('Supervisor/inspectElection',$data);
        }else{
            echo "<h1 style='color:red;'>Forbidden Access!<h1>";
        }
    }
}
