<?php

class Nomination extends Model
{
    protected $nominationID;
    protected $firstname='';
    protected $lastname='';
    protected $election_name='';
    protected $position='';
    protected $party_name='';
    protected $profile_picture='';
    protected $identity_proof='';
    protected $candidateDescription='';
    protected $msg='';

    public function AddNomination($data){
        $this->db->query('INSERT INTO nomination (firstname,lastname,election_name,position,party_name,profile_picture,identity_proof,candidateDescription,msg) VALUES (:firstname,:lastname,:election_name,:position,:party_name,:image_url,:file_urls,:candidateDescription,:msg)');
        //bind values
        // $this->db->bind(':nominationID',$data['nominationID']);
        $this->db->bind(':firstname',$data['firstname']);
        $this->db->bind(':lastname',$data['lastname']);
        $this->db->bind(':election_name',$data['election_name']);
        $this->db->bind(':position',$data['position']);
        // $this->db->bind(':party_names',$data['party_names']);
        $this->db->bind(':party_name',$data['party_name']);
        // $this->db->bind(':party_description',$data['party_description']);
        $this->db->bind(':image_url',$data['profile_picture']);
        $this->db->bind(':file_urls',$data['identity_proof']);
        $this->db->bind(':candidateDescription',$data['candidateDescription']);
        $this->db->bind(':msg',$data['msg']);
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
    public function getElectionName(): string
    {
        return $this->election_name;
    }

    /**
     * @param string $election_name
     */
    public function setElectionName(string $election_name): void
    {
        $this->election_name = $election_name;
    }
/***************************************************************************************/

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }
/***************************************************************************************/
    /**
     * @return mixed
     */
    public function getPartyNames()
    {
        return $this->party_names;
    }

    /**
     * @param mixed $existing_party
     */
    public function setPartyNames($party_names): void
    {
        $this->party_names = $party_names;
    }
/***************************************************************************************/
    /**
     * @return mixed
     */
    public function getPartyName()
    {
        return $this->party_name;
    }

    /**
     * @param mixed $party_name
     */
    public function setPartyName($party_name): void
    {
        $this->party_name = $party_name;
    }
/***************************************************************************************/
    /**
     * @return mixed
     */
    public function getPartyDescription()
    {
        return $this->party_description;
    }

    /**
     * @param mixed $party_description
     */
    public function setPartyDescription($party_description): void
    {
        $this->party_description = $party_description;
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
            'election_name',
            'position',
            'party_names',
            'party_name',
            'party_description',
            'candidateDescription',
            'msg'
        ];
    }

    public function tableName(): string
    {
        return 'nomination';
    }


    public function getNominationDetails() {
        $query = "SELECT * FROM nomination";
        $result = $this->db->query($query);

        return $result->fetchAll();
    }
    
}