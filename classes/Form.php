<?php
class Form {

    private $htmlMainPage;

    private $input=array();
    private $dataForm=array();
    private $errors=array();

    public function __construct(){
        $this->htmlMainPage=file_get_contents("./tpl/mainPage.html");
    }

    public function getMainPaige(){
        return $this->htmlMainPage;
    }



    public function getDataUser(){
        if(isset($_POST["login"]) && isset($_POST["password"]) && !empty($_POST)){
            $_SESSION["login"]=$_POST["login"];
            $_SESSION["password"]=$_POST["password"];
        }
        if(isset($_SESSION["login"]) && isset($_SESSION["password"])){
            return true;
        }else{
            return false;
        }
    }


}