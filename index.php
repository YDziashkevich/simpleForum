<?php
require_once("./inc/inc.php");
date_default_timezone_set('UTC');

//$storage=new Storage();
$mainPage=new Form();

if(!empty($_GET) && isset($_GET) && $_GET=='ok'){
    header('Location: ./tpl/registration.html');
    exit();
}

echo $mainPage->getMainPaige();
//$themes=$storage->getStorage("SELECT * FROM st_themes");