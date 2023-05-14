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
        $this->db->query('INSERT INTO nomination (firstname,lastname,email,profile_picture,identity_proof,candidateDescription,msg,ElectionId,ID,partyId) VALUES (:firstname,:lastname,:email,:image_url,:file_urls,:candidateDescription,:msg,:electId,:ID,:partyId)');
        //bind values

        $this->db->bind(':firstname',$data['firstname']);
        $this->db->bind(':lastname',$data['lastname']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':image_url',$data['profile_picture']);
        $this->db->bind(':file_urls',$data['identity_proof']);
        $this->db->bind(':candidateDescription',$data['candidateDescription']);
        $this->db->bind(':msg',$data['msg']);
        $this->db->bind(':ID',$data['ID']);
        $this->db->bind(':partyId',$data['PartyId']);
        $this->db->bind(':electId',$data['elect_id']);
        //execute

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

        $this->db->query("SELECT partyId FROM `electionparty` WHERE `partyName`='$partyName'");
        $party_id=$this->db->resultSet();

        return $party_id[0]->partyId;
    }

    public function getPosition_Id($positionName){

        $this->db->query("SELECT ID FROM `electionposition` WHERE `positionName`='$positionName'");
        $position_id=$this->db->resultSet();
    
        return $position_id[0]->ID;
    }

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


    public function Attributes(): array
    {
        return [

            'nominationID',
            'firstname',
            'lastname',
            'candidateDescription',
            'msg'
        ];
    }

    public function tableName(): string
    {
        return 'nomination';
    }

        public function getCandidateId($id)
        {
            // var_dump($id);
            
            $this->db->query("SELECT * FROM candidate WHERE CandidateID=$id");
            $id=22;
            // print_r("SELECT `Subject`,`Description` FROM objection WHERE ObjectionID=$id");
            // $this->db->bind(':ObjectionID',$id);
            // $this->db->execute();
            $obj=$this->db->resultSet();
            return $obj;
        }

        public function getObjection($id)
        {
            // var_dump($id);
            
            $this->db->query("SELECT * FROM objection WHERE CandidateID=$id");
            $id=20;
            // print_r("SELECT `Subject`,`Description` FROM objection WHERE ObjectionID=$id");
            // $this->db->bind(':ObjectionID',$id);
            // $this->db->execute();
            $obj=$this->db->resultSet();
            return $obj;
        }

        public function findObjectionBycandidateIdAndElectionId($cid, $eid)
        {
            $this->db->query(
                "SELECT * FROM objection
                WHERE CandidateID = :1 AND ElectionID = :2
                "
            );
            $this->db->bind(':1', $cid);
            $this->db->bind(':2', $eid);
            try {
                return $this->db->resultSet();
            } catch (Exception $e) {
                echo "Something went wrong :" . $e->getMessage();
            }
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

    public function viewRespond($data){
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
    
    public function getNominationsByElectionId($eid){
        $this->db->query("SELECT * FROM nomination WHERE ElectionId=$eid");
        $nominations=$this->db->resultSet();
        return $nominations;
    }

    public function getNominationById($id){
        $this->db->query("SELECT * FROM nomination WHERE nominationID=$id");
        return $this->db->single();
    }

    public function deleteNomination($id){
        $this->db->query("DELETE FROM `nomination` WHERE `nominationID`=$id");
        try {
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
    
