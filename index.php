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
        echo $storage->putUser($user);
        //header('Location: ./index.php');
        //exit();
    }


    $registrationPage=$reg->getPage();
    echo $registrationPage;
}else{

    echo $mainPage->getMainPaige();
}

//$themes=$storage->getStorage("SELECT * FROM st_themes");