<?php

class Registration {
    private $page;
    private $userInfo;
    private $errors=array();
    private $valueForm=array();

    private $captcha;
    private $dataForm=array();



    public function __construct(){
        $this->valueForm["login"]=" ";
        $this->valueForm["email"]=" ";
        $this->errors["login"]=" ";
        $this->errors["email"]=" ";
        $this->errors["password"]=" ";
        $this->errors["confPasswd"]=" ";
        $this->errors["captcha"]=" ";
        $this->page=file_get_contents("./tpl/registration.html");
    }

    //public function getCaptcha(){


    public function getPage(){
        /**
         * генерирование каптчи
         */
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
        $this->captcha=$captchaText;
        /**
         * создание шаблона страницы регистрации
         */
        $this->page=file_get_contents("./tpl/registration.html");
        $this->page=str_replace("{{VALUEEMAIL}}",$this->valueForm["email"],$this->page);
        $this->page=str_replace("{{VALUELOGIN}}",$this->valueForm["login"],$this->page);
        $this->page=str_replace("{{ERROREMAIL}}",$this->errors["email"],$this->page);
        $this->page=str_replace("{{ERRORLOGIN}}",$this->errors["login"],$this->page);
        $this->page=str_replace("{{ERRORPASSWORD}}",$this->errors["password"],$this->page);
        $this->page=str_replace("{{ERRORCONFPASSWD}}",$this->errors["confPasswd"],$this->page);
        $this->page=str_replace("{{ERRORCAPTCHA}}",$this->errors["captcha"],$this->page);
        $this->page=str_replace("{{CAPTCHA}}",$this->captcha,$this->page);
        return $this->page;
    }

    public function getUserInfo(){
        $this->userInfo=file_get_contents("./tpl/infoUser.html");
        $this->userInfo=str_replace("{{LOGIN}}",$this->dataForm["login"],$this->userInfo);
        $this->userInfo=str_replace("{{EMAIL}}",$this->dataForm["email"],$this->userInfo);
        $this->userInfo=str_replace("{{PASSWORD}}",$this->dataForm["password"],$this->userInfo);

        return $this->userInfo;
    }

    public function validateForm($userEmail=array()){
        isset($_POST["login"])?$this->dataForm["login"]=$_POST["login"]:" ";
        isset($_POST["email"])?$this->dataForm["email"]=$_POST["email"]:" ";
        isset($_POST["password"])?$this->dataForm["password"]=$_POST["password"]:" ";
        isset($_POST["confPasswd"])?$this->dataForm["confPasswd"]=$_POST["confPasswd"]:" ";
        isset($_POST["captcha"])?$this->dataForm["captcha"]=$_POST["captcha"]:" ";
        $flagLogin=true;
        $flagEmail=true;
        /**
         * проверка на наличие в базе login и email
         */
        if(isset($_POST) && !empty($_POST)){
            foreach($userEmail as $value){
                foreach($value as $key=>$data){
                    if($key=='login' && $this->dataForm["login"]==$data){
                        $flagLogin=false;
                        echo $flagLogin;
                    }
                    if($key=='email' && $this->dataForm["email"]==$data){
                        $flagEmail=false;
                        echo $flagEmail;
                    }
                }
            }
        }
        /**
         * проверка на соотвествие введеных данных
         */
        $validation = true;
        if(isset($_POST) && !empty($_POST)){
            if(strlen($this->dataForm["login"])<3 ){
                $validation = false;
                $this->errors['login'] = "Имя пользователя должно содержать не менее 3 символов";
                $_POST['login']=" ";
            }elseif(!$flagLogin){
                $validation = false;
                $this->errors['login'] = "Пользователь с таким именем уже существует";
                $_POST['login']=" ";
            }else{
                $this->errors['login'] = " ";
            }
            if(strlen($this->dataForm["email"])<6 && !strpos($this->dataForm["email"],"@")){
                $validation = false;
                $this->errors['email'] = "Неправильно введен email. Должен быть вида example@mail.com";
                $_POST['email']=" ";
            }elseif(!$flagEmail){
                $validation = false;
                $this->errors['email'] = "Пользователь с таким email уже существует";
                $_POST['email']=" ";
            }
            else{
                $this->errors['email'] = " ";
            }
            if(strlen($this->dataForm["password"])<6 && strlen($this->dataForm["password"])>16){
                $validation = false;
                $this->errors['password'] = "Пароль должен содержать от 6 до 16 символов";
                $_POST['password']=" ";
            }else{
                $this->errors['password'] = " ";
            }
            if($this->dataForm["password"]!=$this->dataForm["confPasswd"]){
                $validation = false;
                $this->errors['confPasswd'] = "Пароли должны совпадать";
                $_POST['confPasswd']=" ";
            }else{
                $this->errors["confPasswd"] = " ";
            }
            if($this->dataForm['captcha']!=$_SESSION["ans"]){
                $validation = false;
                $this->errors['captcha'] = "Неправильный ответ";
            }else{
                $this->errors['captcha'] = " ";
            }
        }else{
            $this->errors['login'] = " ";
            $this->errors['email'] = " ";
            $this->errors['password'] = " ";
            $this->errors['confPasswd'] = " ";
            $this->errors['captcha'] = " ";
            $validation = false;
        }
        return $validation;
    }
} 