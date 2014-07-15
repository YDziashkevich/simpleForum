<?php
require_once("./inc/inc.php");
date_default_timezone_set('UTC');

//$storage=new Storage();
$mainPage=new Form();

if(!empty($_GET) && $_GET['reg']=='ok'){
    $reg=new Registration();
    $validateUser=$reg->validateForm();
    var_dump($validateUser);
    $registrationPage=$reg->getPage();
    echo $registrationPage;
}else{

    echo $mainPage->getMainPaige();
}

//$themes=$storage->getStorage("SELECT * FROM st_themes");