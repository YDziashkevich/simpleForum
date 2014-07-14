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

    public function getCaptcha(){
        $a=rand(10, 18);
        $b=rand(1, 9);
        $symbol=(rand(0, 1))?"+":"-";
        switch ($symbol){
            case "+":
                $ans=$a+$b;
                $captchaText="$a+$b"."=";
                break;
            case "-":
                $ans=$a-$b;
                $captchaText="$a-$b"."=";
                break;
        }
        $_SESSION["ans"]=$ans;
        $this->input["captcha"]=$captchaText;
    }

    public function getDataUser(){
        if(isset($_POST["login"])){
            $_SESSION["login"]=$_POST["login"];}
        if(isset($_POST["email"])){
            $_SESSION["password"]=$_POST["email"];}
    }

    public function validateDataUser(){
        $validation = true;
        if(isset($_POST)&&!empty($_POST)){
            if(!preg_match('/^\D{3,}$/', $this->dataForm["name"])){
                $validation = false;
                $this->errors['name'] = "Имя пользователя должно содержать не менее 3 символов";
                $_POST['name']=" ";
            }else{
                $this->errors['name'] = " ";
            }
            if(!preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/',$this->dataForm["email"])){
                $validation = false;
                $this->errors['email'] = "Неправильно введен email. Должен быть вида example@mail.com";
                $_POST['email']=" ";
            }else{
                $this->errors['email'] = " ";
            }
            if(strlen($this->dataForm["message"])<15){
                $validation = false;
                $this->errors['message'] = "Сообщение пользователя должно содержать не менее 15 символов";
                $_POST['message']=" ";
            }else{
                $this->errors['message'] = " ";
            }
            if($this->dataForm['captcha']!=$_SESSION["ans"]){
                $validation = false;
                $this->errors['captcha'] = "Неправильный ответ";
            }else{
                $this->errors['captcha'] = " ";
            }
        }else{
            $this->errors['name'] = " ";
            $this->errors['email'] = " ";
            $this->errors['message'] = " ";
            $this->errors['captcha'] = " ";
        }
        if(!$validation){
            return false;
        }else{
            return true;
        }
    }

    public function getHtml($messages=" ", $paginator=" "){
        $htmlPage=file_get_contents("./tpl/page.tpl");
        $htmlPage=str_replace("{{NAME}}",$this->input["name"],$htmlPage);
        $htmlPage=str_replace("{{EMAIL}}",$this->input["email"],$htmlPage);
        $htmlPage=str_replace("{{MESSAGE}}",$this->input["message"],$htmlPage);
        $htmlPage=str_replace("{{CAPTCHA}}",$this->input["captcha"],$htmlPage);
        $htmlPage=str_replace("{{ERRORNAME}}",$this->errors["name"],$htmlPage);
        $htmlPage=str_replace("{{ERROREMAIL}}",$this->errors["email"],$htmlPage);
        $htmlPage=str_replace("{{ERRORMESSAGE}}",$this->errors["message"],$htmlPage);
        $htmlPage=str_replace("{{ERRORCAPTCHA}}",$this->errors["captcha"],$htmlPage);
        $htmlPage=str_replace("{{MESSAGES}}",$messages,$htmlPage);
        $htmlPage=str_replace("{{PAGINATOR}}",$paginator,$htmlPage);
        return $htmlPage;
    }
} 