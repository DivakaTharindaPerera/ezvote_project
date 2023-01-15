<?php

session_start();

class Candidate extends Controller{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
}