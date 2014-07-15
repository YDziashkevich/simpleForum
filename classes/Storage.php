<?php

class Storage{
    private $db;

    public function __construct($host="localhost", $dbName="forum_st", $user="root", $password=" "){
        try{
            $this->db = new PDO("mysql: host=$host; dbname=$dbName", $user, $password);
            $this->db->exec("set names utf8");
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public function __destruct(){
        $this->db=null;
    }
    public function getStorage($query){
        $this->db->query("SET CHARACTER SET utf8");
        $queryDb=$this->db->query($query);
        $queryDb->db->setFetchMode(PDO::FETCH_ASSOC);
        $rezultQuery = $queryDb->fetchAll();
        return $rezultQuery;
    }
}