<?php
require_once "./components/form.php";
require_once "./controllers/login_register.php";

class RunApp {
    public static function header(){
        require_once "./components/header.php";    
    }

    public static function footer(){
        require_once "./components/footer.php";    
    }

    public static function login(){
        $form = new Form("login");
        $form->setHeading("Welcome&nbspTo DOIT&nbspApp");
        $form->html();
    }

    public static function register(){
        $form = new Form("register");
        $form->setHeading("Register&nbspIn DOIT&nbspApp");
        $form->html();
    }

    public static function loginRegisterController($globalPostValiable){
        (new LoginRegisterController)->processRegister($globalPostValiable);
    }
};