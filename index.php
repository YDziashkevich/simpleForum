<?php
require_once("./inc/inc.php");
date_default_timezone_set('UTC');

$storage=new Storage();
$mainPage=new Form();

if(!empty($_GET) && $_GET['reg']=='ok'){
    $reg=new Registration();
    $userEmail=$storage->getStorage("SELECT login, email FROM st_users");
    var_dump($userEmail);
    $validateUser=$reg->validateForm($userEmail);
    var_dump($validateUser);
    $registrationPage=$reg->getPage();
    echo $registrationPage;
}else{

    echo $mainPage->getMainPaige();
}

//$themes=$storage->getStorage("SELECT * FROM st_themes");