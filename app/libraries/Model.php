<?php

abstract class Model
{
    protected $db;
    abstract public function Attributes():array;
    abstract public function tableName():string;
    public function __construct(){
        $this->db = new Database;
    }
    public function loadData()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            foreach ($_POST as $key=>$value){
                if(isset($key)){
                    $$key=$value;
                }
            }
        }
    }

    public function RetrieveAll()
    {
        $tableName=$this->tableName();
        $sql="SELECT * FROM $tableName";
        $db=new Database();
        $db->query($sql);
        return $db->resultSet();

    }

    public function save(){

    }

}