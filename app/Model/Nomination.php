<?php

class Nomination extends Model
{
    protected $nominationID;
    protected $firstname='';
    protected $lastname='';
    // protected $election_name='';
    // protected $position='';
    // protected $party_name='';
    protected $profile_picture='';
    protected $identity_proof='';
    protected $candidateDescription='';
    protected $msg='';
    protected $ObjectionID;
    protected $Subject='';
    protected $Description='';

    public function AddNomination($data){
        // $this->db->query('INSERT INTO nomination (firstname,lastname,election_name,position,party_name,profile_picture,identity_proof,candidateDescription,msg) VALUES (:firstname,:lastname,:election_name,:position,:party_name,:image_url,:file_urls,:candidateDescription,:msg)');
        // var_dump($data);
        // die();//die();//die();//die();//die();//die();//die();//die();//die();//die(
        $this->db->query('INSERT INTO nomination1 (firstname,lastname,profile_picture,identity_proof,candidateDescription,msg,ElectionID,ID,partyId) VALUES (:firstname,:lastname,:image_url,:file_urls,:candidateDescription,:msg,:ElectionID,:ID,:partyId)');
        //bind values
        // $this->db->bind(':nominationID',$data['nominationID']);
        $this->db->bind(':firstname',$data['firstname']);
        $this->db->bind(':lastname',$data['lastname']);
        // $this->db->bind(':election_name',$data['election_name']);
        // $this->db->bind(':position',$data['position']);
        // $this->db->bind(':party_names',$data['party_names']);
        // $this->db->bind(':party_name',$data['party_name']);
        // $this->db->bind(':party_description',$data['party_description']);
        $this->db->bind(':image_url',$data['profile_picture']);
        $this->db->bind(':file_urls',$data['identity_proof']);
        $this->db->bind(':candidateDescription',$data['candidateDescription']);
        $this->db->bind(':msg',$data['msg']);
        $this->db->bind(':ElectionID',$data['ElectionID']);
        $this->db->bind(':ID',$data['ID']);
        $this->db->bind(':partyId',$data['PartyId']);
        //execute

        // try {
        //     $this->db->execute();
        //     return true;

        // } catch (\Throwable $th) {
        //     echo $th;
        //     return false;
        // }
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getNominationID(){
        return $this->nominationID;
    }

    /**
     * @param mixed $nominationID
     */
    public function setNominationID($nominationID): void{
        $this->nominationID = $nominationID;
    }
/***************************************************************************************/
    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstName(string $firstname): void
    {
        $this->firstname = $firstname;
    }
/***************************************************************************************/
     /**
     * @return string
     */
    // public function getElectionName(): string
    // {
    //     return $this->election_name;
    // }

    /**
     * @param string $election_name
     */
    // public function setElectionName(string $election_name): void
    // {
    //     $this->election_name = $election_name;
    // }

    public function getElectionID()
    {
        return $this->ElectionID;
    }

    /**
     * @param mixed $ElectionID
     */
    public function setElectionID($ElectionID): void
    {
        $this->ElectionID = $ElectionID;
    }


    public function getElect_Id($electName){
        // var_dump($electName);
        // print_r("SELECT ElectionId FROM `election` WHERE `Title`=$electName");
        $this->db->query("SELECT ElectionId FROM `election` WHERE `Title`='$electName'");
        $elect_id=$this->db->resultSet();

        try {
            return $elect_id[0]->ElectionId;
        } catch (\Throwable $e) {
            var_dump($e);
        }

        // var_dump($elect_id[0]->ElectionId);
       
    }


    public function getParty_Id($partyName){
        // var_dump($partyName);
        // print_r("SELECT partyId FROM `electionparty` WHERE `partyName`='$partyName'");
        $this->db->query("SELECT partyId FROM `electionparty` WHERE `partyName`='$partyName'");
        $party_id=$this->db->resultSet();
        var_dump($party_id);

        return $party_id[0]->partyId;
    }

    public function getPosition_Id($positionName){
        // var_dump($positionName);
        // print_r("SELECT partyId FROM `electionparty` WHERE `partyName`='$partyName'");
        $this->db->query("SELECT ID FROM `electionposition` WHERE `positionName`='$positionName'");
        $position_id=$this->db->resultSet();
        // var_dump($position_id);
    
        return $position_id[0]->ID;
    }
/***************************************************************************************/

    /**
     * @return string
     */
    // public function getPosition(): string
    // {
    //     return $this->position;
    // }

    // /**
    //  * @param string $position
    //  */
    // public function setPosition(string $position): void
    // {
    //     $this->position = $position;
    // }

    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ElectionID
     */
    public function setID($ID): void
    {
        $this->ID = $ID;
    }
/***************************************************************************************/
    /**
     * @return mixed
     */
    // public function getPartyNames()
    // {
    //     return $this->party_names;
    // }

    // /**
    //  * @param mixed $existing_party
    //  */
    // public function setPartyNames($party_names): void
    // {
    //     $this->party_names = $party_names;
    // }

    public function getpartyId()
    {
        return $this->partyId;
    }

    /**
     * @param mixed $ElectionID
     */
    public function setpartyId($partyId): void
    {
        $this->partyId = $partyId;
    }

    /***************************************************************************************/
    /**
     * @return mixed
     */
    public function getProfilePicture()
    {
        return $this->profile_picture;
    }

    /**
     * @param mixed $party_description
     */
    public function setProfilePicture($profile_picture): void
    {
        $this->profile_picture = $profile_picture;
    }

        /***************************************************************************************/
    /**
     * @return mixed
     */
    public function getIdentityProof()
    {
        return $this->identity_proof;
    }

    /**
     * @param mixed $party_description
     */
    public function setIdentityProof($identity_proof): void
    {
        $this->identity_proof = $identity_proof;
    }

/***************************************************************************************/
    /**
     * @return mixed
     */
    public function getCandidateDescription()
    {
        return $this->candidateDescription;
    }

    /**
     * @param mixed $candidateDescription
     */
    public function setCandidateDescription($candidateDescription): void
    {
        $this->candidateDescription = $candidateDescription;
    }
/***************************************************************************************/
    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg): void
    {
        $this->msg = $msg;
    }


    /***************************************************************************************/
    // protected $Action;
    // protected $CandidateID;
    // protected $ElectionID;
    // protected $VoterID;


    public function Attributes(): array
    {
        return [
            // 'ObjectionID',
            // 'Subject',
            // 'Description',
            // 'Respond',
            // 'Action',
            // 'CandidateID',
            // 'ElectionID',
            // 'VoterID'

            'nominationID',
            'firstname',
            'lastname',
            // 'election_name',
            // 'position',
            // 'party_names',
            // 'party_name',
            // 'party_description',
            'candidateDescription',
            'msg'
        ];
    }

    public function tableName(): string
    {
        return 'nomination';
    }


    // public function getNominationDetails() {
    //     $query = "SELECT * FROM nomination";
    //     $result = $this->db->query($query);

    //     return $result->fetchAll();
    // }

    // public function getNominationDetails($id) {
    //     $query = "SELECT * FROM nomination WHERE nominationID = :id LIMIT 1";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute(array(':id' => $id));
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $row;
    // }

    public function updateCandidateProfile($nominationID,$firstname,$lastname,$election_name,$position,$party_name,$candidateDescription,$msg) {
        // public function updateSubscriptionplan($plan,$name,$description, $cur_Date, $day, $month, $year, $price, $fullaccess, $voter_limit, $cand_limit, $election_limit, $manager_ID){
            $this->db->query('UPDATE candidate SET candidateName=:candidateName,candidateEmail=:candidateEmail,position=:position,party_name=:party_name,candidateDescription=:candidateDescription,msg=:msg WHERE nominationID = :nominationID');
    
            // $this->db->bind(':nominationID',$data['nominationID']);
            $this->db->bind(':candidateName',$candidateName);
            $this->db->bind(':candidateEmail',$candidateEmail);
            // $this->db->bind(':election_name',$election_name);
            $this->db->bind(':position',$position);
        // $this->db->bind(':party_names',$data['party_names']);
            $this->db->bind(':party_name',$party_name);
        // $this->db->bind(':party_description',$data['party_description']);
            // $this->db->bind(':image_url',$profile_picture);
            // $this->db->bind(':file_urls',$data['identity_proof']);
            $this->db->bind(':description',$description);
            $this->db->bind(':vision',$vision);
            // $this->db->bind(':nominationID',$nominationID);

    
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }


        // public function getById($candidateId)
        // {
        //     $this->$db = Database::getInstance();
        //     $this->db->query('SELECT candidateName,Title,partyName,positionName,description,vision
        //             FROM candidate
        //             JOIN election ON candidate.electionid = election.ElectionId
        //             JOIN electionparty ON candidate.partyId = elctionparty.partyId
        //             JOIN electionposition ON candidate.positionId = electionposition.ID
        //             WHERE candidate.candidateId = :candidateId');
        //     $stmt = $this->$db->prepare($this->db->query);
        //     $stmt->execute([':candidateId' => $candidateId]);
        //     $candidateData = $stmt->fetch(PDO::FETCH_ASSOC);
        //     return $candidateData;
        // }

        public function getObjection($id)
        {
            var_dump($id);
            
            $this->db->query("SELECT * FROM objection WHERE CandidateID=$id");
            $id=20;
            // print_r("SELECT `Subject`,`Description` FROM objection WHERE ObjectionID=$id");
            // $this->db->bind(':ObjectionID',$id);
            // $this->db->execute();
            $obj=$this->db->resultSet();
            return $obj;
        }

    public function respondToObjection($data){
        // var_dump($data);
        $this->db->query("UPDATE `objection` SET Respond = :Respond WHERE ObjectionID = :ObjectionID;");
        //bind values
        $this->db->bind(':ObjectionID',$data['ObjectionID']);
        $this->db->bind(':Respond',$data['Respond']);
        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    

    public function getObjectionID()
    {
        return $this->ObjectionID;
    }

    /**
     * @param mixed $ObjectionID
     */
    public function setObjectionID($ObjectionID): void
    {
        $this->ObjectionID = $ObjectionID;
    }
    }
    
