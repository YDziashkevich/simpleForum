<?php
require_once("./inc/inc.php");
date_default_timezone_set('UTC');

$storage=new Storage();
$mainPage=new Form();

echo $mainPage->getMainPaige();
$themes=$storage->getStorage("SELECT * FROM st_themes");