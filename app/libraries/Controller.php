<?php


//    session_start();

class Controller
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
    }

    public function model($model)
    {

        require_once '../app/Model/' . $model . '.php';

        return new $model();
    }

    public function view($view, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        if (file_exists('../app/View/' . $view . '.php')) {
            require_once '../app/View/' . $view . '.php';
        } else {
            die('View does not exist: ' . $view);
        }
    }

    //for login
    public function logged($email, $password, $users)
    {
        foreach ($users as $user) {

            if ($user->Email === $email) {
                if (password_verify($password, $user->Password)) {

                    session_start();

                    //to prevent the session attacks 
                    session_regenerate_id();

                    $_SESSION["UserId"] = $user->UserId;
                    $_SESSION["fname"] = $user->Fname;
                    $_SESSION["lname"] = $user->Lname;
                    $_SESSION["email"] = $user->Email;

                    // header('location: '.urlroot.'/Pages/dashboard');
                    redirect('Pages/dashboard');
                } else {
                    $data = [
                        'error' => "invalid password",
                        'email' => $email
                    ];
                    $this->view('login', $data);
                }
            }
        }
    }

    public function logout()
    {
        unset($_SESSION["UserId"]);
        session_start();
        session_destroy();

        redirect('View/login');
    }

    public function isLoggedIn(): bool
    {
        if (isset($_SESSION["UserId"])) {
            return true;
        } else {
            return false;
        }
    }

    public function IsPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        } else {
            return false;
        }
    }

    


    //     public function index() {
    //         $students = $this->model->getNominationDetails();

    //         include approot.'/view/Candidate/candidateProfile.php';

    // }
}
