<?php
require_once("./inc/inc.php");
date_default_timezone_set('UTC');

$storage=new Storage();
$mainPage=new Form();

$userData;
$htmlLogin;

if(!empty($_GET) &&isset($_GET['reg']) && $_GET['reg']=='ok'){
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

    //Логирование пользователя
    $mainPage->getDataUser();// получение данных из пост в сессию
    $valUser=$storage->validateUser();//валидация данных

    //выход пользователя, $_SESSION["log"] если существует, значит пользователь в системе
    if(isset($_GET['loginUser']) && $_GET['loginUser']=='out'){
        session_unset();
        session_destroy();
        header('Location: /simpleForum/index.php');//удаление данных из пост, для предотвращения повторной отправки
        exit();
    }

    //вывод имени пользовател и ссылки на выход вместо формы регистрации
    if(isset($_SESSION["log"]) && $_SESSION["log"]==true && $valUser){
        $userData=$_SESSION["login"];
        $htmlLogin="<h2><a href='?loginUser=in'>$userData</a> </h2></br><h4><a href='?loginUser=out'>logOut</a> </h4>";

    }else{
        $htmlLogin=file_get_contents("./tpl/logIn.html");
    }
    echo $mainPage->getMainPaige($htmlLogin);
}