<?php
require_once __DIR__ . "/../components/form.php";
require_once __DIR__ . "/../controllers/registerController.php";
require_once __DIR__ . "/../controllers/loginController.php";
require_once __DIR__ . "/../components/logout.php";
require_once __DIR__ . "/../controllers/logoutController.php";

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

    public static function registerController($globalPostValiable){
        (new RegisterController)->processRegister($globalPostValiable);
    }

    public static function loginController($globalPostValiable){
        (new LoginController)->processLogin($globalPostValiable);
    }

    public static function logoutController(){
        (new Logout)->html();
        (new LogoutController)->logout();
    }
};