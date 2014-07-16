<?php

class Storage{
    private $db;

    public function __construct($host="localhost", $dbName="forum_st", $user="root", $password=""){
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

    public function matchUserData($query, $param=array()){
        $this->db->query("SET CHARACTER SET utf8");
        $queryDb=$this->db->prepare($query);
        $queryDb->bindParam(':login', $param["login"]);
        $queryDb->bindParam(':email', $param["email"]);
        $queryDb->execute();
        $count = count($queryDb->fetchAll(PDO::FETCH_ASSOC));
        return $count;
    }

    public function putUser($user=array()){
        //$data = array( 'login' => $user["login"], 'email' => $user["email"], 'password' => $user["password"]);
        $putUser = $this->db->prepare("INSERT INTO st_userMessage (login, email, password) value (:login, :email, :password)");
        $putUser->bindParam(':login', $user["login"]);
        $putUser->bindParam(':email', $user["email"]);
        $putUser->bindParam(':password', $user["password"]);
        return $putUser->execute();

    }


    /*
    public function getStorage($query){
        $this->db->query("SET CHARACTER SET utf8");
        $queryDb=$this->db->query($query);
        $rezultQuery = $queryDb->fetchAll(PDO::FETCH_ASSOC);
        return $rezultQuery;
    }
    */


}