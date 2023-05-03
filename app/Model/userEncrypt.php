<?php

class userEncrypt extends Controller
{

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function hashUser($uid){
        $hash = password_hash($uid, PASSWORD_DEFAULT);
        return $hash;
    }

    public function storeKey($user,$key, $iv){
        $this->db->query('INSERT INTO UserEncrypt VALUES (:user, :key, :iv)');
        $this->db->bind(':user', $user);
        $this->db->bind(':key', $key);
        $this->db->bind(':iv', $iv);
        
        try{
            $this->db->execute();
            return true;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function getKeyAndIv($vid){
        $this->db->query('SELECT * FROM UserEncrypt WHERE User = :user');
        $this->db->bind(':user', $vid);
        try{
            $row = $this->db->single();
            return $row;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}