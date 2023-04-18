<?php

class Contact extends Model
{
        public $name;
        public $email;
        public $subject;
        public $message;
      
        public function AddContactUs($name, $email, $subject, $message) {
          $this->name = $name;
          $this->email = $email;
          $this->subject = $subject;
          $this->message = $message;
        }
      

    



    // public function AddContactUs($data){
    //     // $this->db->query('INSERT INTO nomination (firstname,lastname,election_name,position,party_name,profile_picture,identity_proof,candidateDescription,msg) VALUES (:firstname,:lastname,:election_name,:position,:party_name,:image_url,:file_urls,:candidateDescription,:msg)');
    //     // var_dump($data);
    //     $this->db->query('INSERT INTO nomination1 (firstname,lastname,profile_picture,identity_proof,candidateDescription,msg,ElectionID,ID,partyId) VALUES (:firstname,:lastname,:image_url,:file_urls,:candidateDescription,:msg,:ElectionID,:ID,:partyId)');
    //     //bind values
    //     // $this->db->bind(':nominationID',$data['nominationID']);
    //     $this->db->bind(':firstname',$data['firstname']);
    //     $this->db->bind(':lastname',$data['lastname']);
    //     // $this->db->bind(':election_name',$data['election_name']);
    //     // $this->db->bind(':position',$data['position']);
    //     // $this->db->bind(':party_names',$data['party_names']);
    //     // $this->db->bind(':party_name',$data['party_name']);
    //     // $this->db->bind(':party_description',$data['party_description']);
    //     $this->db->bind(':image_url',$data['profile_picture']);
    //     $this->db->bind(':file_urls',$data['identity_proof']);
    //     $this->db->bind(':candidateDescription',$data['candidateDescription']);
    //     $this->db->bind(':msg',$data['msg']);
    //     $this->db->bind(':ElectionID',$data['ElectionID']);
    //     $this->db->bind(':ID',$data['ID']);
    //     $this->db->bind(':partyId',$data['PartyId']);
    //     //execute

    //     // try {
    //     //     $this->db->execute();
    //     //     return true;

    //     // } catch (\Throwable $th) {
    //     //     echo $th;
    //     //     return false;
    //     // }
    //     if($this->db->execute()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
 }
    
