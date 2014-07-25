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
        $putUser = $this->db->prepare("INSERT INTO st_users (login, email, password) value (:login, :email, :password)");
        $putUser->bindParam(':login', $user["login"]);
        $putUser->bindParam(':email', $user["email"]);
        $putUser->bindParam(':password', $user["password"]);
        return $putUser->execute();

    }

    //валидация параметров при входе пользователя
    public function validateUser(){
        if(isset($_SESSION["login"]) && isset($_SESSION["password"])){
            $this->db->query("SET CHARACTER SET utf8");
            $queryUser=$this->db->prepare("SELECT login, password FROM st_users WHERE login = :login AND password = :password");
            $queryUser->bindParam(':login', $_SESSION["login"]);
            $queryUser->bindParam(':password', $_SESSION["password"]);
            $queryUser->execute();
            $dataUser = $queryUser->fetchAll(PDO::FETCH_ASSOC);
                if(!$dataUser){
                    return false;
                }else{
                    $_SESSION["log"]=true;
                    return true;
                }
        }else{
            return false;
        }
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