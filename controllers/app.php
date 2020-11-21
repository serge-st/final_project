<?php
require_once __DIR__ . "/../components/doItContents.php";
require_once __DIR__ . "/../components/logout.php";
require_once __DIR__ . "/../components/form.php";
require_once __DIR__ . "/doItDataController.php";
require_once __DIR__ . "/loginController.php";
require_once __DIR__ . "/logoutController.php";
require_once __DIR__ . "/registerController.php";
require_once __DIR__ . "/sessionVerifyController.php";

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

    public static function registerController(){
        (new RegisterController)->processRegister();
    }

    public static function loginController(){
        (new LoginController)->processLogin();
    }

    public static function logoutController(){
        (new Logout)->html();
        (new LogoutController)->logout();
    }

    public static function verifySession(){
        (new SessionVerifier)->verify();
    }

    public static function displayUserData($userId){
        (new DoItContents($userId))->displayName();
    }
};