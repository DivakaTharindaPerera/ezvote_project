<?php

class PartyOwnerRequest extends Model
{
    protected $request_id;
    protected $candidate_id='';
    protected $candidate_name='';
    protected $candidate_vision='';
    protected $identity_proof='';
    protected $status='';



    /**
     * @return mixed
     */
    public function getRequestId(){
        return $this->request_id;
    }

    /**
     * @param mixed $nominationID
     */
    public function setRequestId($request_id): void{
        $this->request_id = $request_id;
    }

     /**
     * @return mixed
     */
    public function getCandidateId(){
        return $this->candidate_id;
    }

    /**
     * @param mixed $nominationID
     */
    public function setCandidateId($candidate_id): void{
        $this->candidate_id = $candidate_id;
    }
/***************************************************************************************/
    /**
     * @return string
     */
    public function getCandidateName(): string
    {
        return $this->candidate_name;
    }

    /**
     * @param string $firstname
     */
    public function setCandidateName(string $candidate_name): void
    {
        $this->candidate_name = $candidate_name;
    }
/***************************************************************************************/
   /**
     * @return string
     */
    public function getCandidateVision(): string
    {
        return $this->candidate_vision;
    }

    /**
     * @param string $firstname
     */
    public function setCandidateVision(string $candidate_vision): void
    {
        $this->candidate_vision = $candidate_vision;
    }

    public function getIdentityProof()
    {
        return $this->identity_proof;
    }

    /**
     * @param mixed $ElectionID
     */
    public function setIdentityProof($identity_proof): void
    {
        $this->identity_proof = $identity_proof;
    }
    

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $ElectionID
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function Attributes(): array
    {
        return [
 
            'request_id',
            'candidate_id',
            'candidate_name',
            'candidate_vision',
            'identity_proof',
            'status',
        ];
    }

    public function tableName(): string
    {
        return 'party_owner_request';
    }

    public function AddPartyRequest($data){
        $this->db->query('INSERT INTO party_owner_request (user_id,candidate_Id,election_id,candidate_name,candidate_vision,identity_proof,partyId) VALUES (:user_id,:candidateId,:ElectionID,:candidateName,:msg,:file_urls,:partyId)');
        $candidateName = $data['firstname'] . ' ' . $data['lastname'];
        $this->db->bind(':candidateName',$candidateName);
        $this->db->bind(':file_urls',$data['identity_proof']);
        $this->db->bind(':msg',$data['msg']);
        $this->db->bind(':ElectionID',$data['ElectionID']);
        $this->db->bind(':user_id',$data['user_Id']);
        $this->db->bind(':partyId',$data['PartyId']);
        $this->db->bind(':candidateId',$data['candidate_id']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getPartyRequests($candidate_id){
        $this->db->query("SELECT * FROM party_owner_request WHERE user_id = $candidate_id ORDER BY request_id DESC;
        ");
        try {
            $this->db->execute();
            return $this->db->resultSet();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
        }
    }

    public function partyAccepted($request_id){
        $status=1;
        $this->db->query("UPDATE `party_owner_request` SET `status` = :Respond WHERE request_id = $request_id;");
        //bind values
        $this->db->bind(':Respond',$status);
        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function partyRejected($data){
        $status=2;
        $request_id=intval($data['request_id']);
        $this->db->query("UPDATE `party_owner_request` SET `status` = :Respond WHERE request_id = $request_id;");
        //bind values
        $this->db->bind(':Respond',$status);
        //execute
        if($this->db->execute()){
            $this->db->query("INSERT INTO `rejected_request` VALUES (:request_id,:reason)");
            $this->db->bind(':request_id',$request_id);
            $this->db->bind(':reason',$data['reason']);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
            
        }else{
            return false;
        }
    }

    public function getNominationData($nomination_id){
        $this->db->query("SELECT * FROM nomination WHERE nomination_id = $nomination_id");
        try {
            $this->db->execute();
            return $this->db->resultSet();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
        }
    }

    public function getPartyRequestsByElectionAndUser($electionID,$userID){
       
        $this->db->query("SELECT * FROM party_owner_request WHERE candidate_id = $userID AND election_id=$electionID");
        try {
            $this->db->execute();
            return $this->db->resultSet();
        } catch (Exception $e) {
            echo "Something went wrong :".$e->getMessage();
        }
    }



}