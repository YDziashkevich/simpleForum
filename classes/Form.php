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
        if(isset($_POST["login"])){
            $_SESSION["login"]=$_POST["login"];}
        if(isset($_POST["email"])){
            $_SESSION["password"]=$_POST["password"];}
        return $_SESSION["login"];
    }




} 