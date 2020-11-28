<?php
require_once __DIR__ . "/../components/logout.php";
require_once __DIR__ . "/../components/form.php";
require_once __DIR__ . "/doItDataController.php";
require_once __DIR__ . "/loginController.php";
require_once __DIR__ . "/logoutController.php";
require_once __DIR__ . "/registerController.php";
require_once __DIR__ . "/sessionVerifyController.php";
require_once __DIR__ . "/sessionRedirectController.php";

class RunApp {
    public static function header(){
        require_once "./components/header.php";    
    }

    public static function mainSection(){
        require_once "./components/mainSection.php";    
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

    public static function sessionVerifyController(){
        (new SessionVerifier)->verify();
    }

    public static function doItDataController(){
        (new DoItContents)->displayName();
    }

    public static function sessionRedirectController(){
        (new SessionRedirectController)->activate();
    }
};