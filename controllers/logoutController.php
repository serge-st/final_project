<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

class LogoutController {
    
    public function logout(){
        if (isset($_POST["logout"])){
            // delete session from DB
            $userId = $_SESSION["user_id"];
            DB::run("DELETE FROM `user_sessions` WHERE `user_id`= '$userId'");
            // destroy session
            $_SESSION = array();
            var_dump($_SESSION);
            session_destroy();
            header("location: /final_project/login.php");
        }
    }
}