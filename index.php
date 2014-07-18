<?php
require_once("./inc/inc.php");
date_default_timezone_set('UTC');

$storage=new Storage();
$mainPage=new Form();

if(!empty($_GET) && $_GET['reg']=='ok'){
    $reg=new Registration();
    $user=$reg->getUserInfo();
    $matchUser=$storage->matchUserData("SELECT login, email FROM st_users WHERE login = :login OR email = :email",$user);
    $validateUser=$reg->validateForm($matchUser);
    if($validateUser && $user){
        $registration=$storage->putUser($user);
        if($registration){
            header('Location: /simpleForum/index.php');
            exit();
        }
    }


    $registrationPage=$reg->getPage();
    echo $registrationPage;
}else{
    if(!empty($_POST) && isset($_POST)){
        if($mainPage->getDataUser()){
            var_dump($storage->validateUser());
        }
    }
    echo $mainPage->getMainPaige();
}