<?php

class Objection extends Model
{
    protected $ObjectionID;
    protected $Subject='';
    protected $Description='';
    protected $Respond;

    public function AddObjection($data){
        $this->db->query('INSERT INTO objection (ObjectionID,Subject,Description,Respond,Action,ElectionID,CandidateID,VoterID) VALUES (:ObjectID,:Subject,:Description,:Respond,:Action,:ElectionID,:CandidateID,:VoterID)');
        //bind values
        $this->db->bind(':ObjectID',$data['objectionID']);
        $this->db->bind(':Subject',$data['Subject']);
        $this->db->bind(':Description',$data['Description']);
        $this->db->bind(':Respond',$data['Respond']);
        $this->db->bind(':Action',$data['Action']);
        $this->db->bind(':ElectionID',$data['ElectionID']);
        $this->db->bind(':CandidateID',$data['CandidateID']);
        $this->db->bind(':VoterID',$data['VoterID']);
        //execute
//        if($this->db->execute()){
//            return true;
//        }else{
//
//            return false;
//        }
        try {
            $this->db->execute();
        } catch (Exception $e) {
//            return false;
            throw $e;
        }
    }
//    {
//        $tableName=$this->tableName();
//        $attributes=$this->Attributes();
//        $sql="INSERT INTO $tableName (";
//        $sql.=implode(',',$attributes);
//        $sql.=") VALUES (";
//        $sql.=implode(',',array_map(function($attr){return ":$attr";},$attributes));
//        $sql.=")";
//        $this->db->query($sql);
//        foreach ($attributes as $attr){
//            $this->db->bind(":$attr",$this->$attr);
//        }
//        $this->db->execute();
//    }
    public function DeleteObjection($id)
    {
        $this->db->query('DELETE FROM objection WHERE ObjectionID=:ObjectionID');
        $this->db->bind(':ObjectionID',$id);
        $this->db->execute();
    }

    public function showObjectionsByElectionAndCandidateId($electionId,$candidateId)
    {
        $this->db->query('SELECT * FROM objection WHERE ElectionID=:ElectionID AND CandidateID=:CandidateID');
        $this->db->bind(':ElectionID',$electionId);
        $this->db->bind(':CandidateID',$candidateId);
        $results=$this->db->resultSet();
        return $results;
    }

    public function getCandidateName($id)
    {
        $this->db->query('SELECT candidateName FROM candidate WHERE CandidateID=:CandidateID');
        $this->db->bind(':CandidateID',$id);
        $row=$this->db->single();
        return $row;
    }

    /**
     * @return mixed
     */
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

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->Subject;
    }

    /**
     * @param string $Subject
     */
    public function setSubject(string $Subject): void
    {
        $this->Subject = $Subject;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     */
    public function setDescription(string $Description): void
    {
        $this->Description = $Description;
    }

    /**
     * @return mixed
     */
    public function getRespond()
    {
        return $this->Respond;
    }

    /**
     * @param mixed $Respond
     */
    public function setRespond($Respond): void
    {
        $this->Respond = $Respond;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->Action;
    }

    /**
     * @param mixed $Action
     */
    public function setAction($Action): void
    {
        $this->Action = $Action;
    }

    /**
     * @return mixed
     */
    public function getCandidateID()
    {
        return $this->CandidateID;
    }

    /**
     * @param mixed $CandidateID
     */
    public function setCandidateID($CandidateID): void
    {
        $this->CandidateID = $CandidateID;
    }

    /**
     * @return mixed
     */
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

    /**
     * @return mixed
     */
    public function getVoterID()
    {
        return $this->VoterID;
    }

    /**
     * @param mixed $VoterID
     */
    public function setVoterID($VoterID): void
    {
        $this->VoterID = $VoterID;
    }
    protected $Action;
    protected $CandidateID;
    protected $ElectionID;
    protected $VoterID;


    public function Attributes(): array
    {
        return [
            'ObjectionID',
            'Subject',
            'Description',
            'Respond',
            'Action',
            'CandidateID',
            'ElectionID',
            'VoterID'
        ];
    }

    public function tableName(): string
    {
        return 'objection';
    }
}