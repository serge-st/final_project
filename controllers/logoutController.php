<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

class LogoutController {
    
    public function logout(){
        if (isset($_POST["logout"])){
            // delete session from DB
            $_SESSION = array();
            var_dump($_SESSION);
            session_destroy();
            header("location: /final_project/login.php");
        }
    }
}