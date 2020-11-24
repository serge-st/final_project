<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";


class SessionVerifier {
    
    public function verify(){
        session_start();
        // REDIRECT IF SESSION ID WAS NOT CREATED
        if (empty($_SESSION["session_id"])) {
            // querry DB for user and session
            header("location: /final_project/login.php");
            exit(0);
        }
        $userId = $_SESSION["user_id"];
        $userSession = DB::run("SELECT `session_id` FROM `user_sessions` WHERE `user_id` = '$userId'")->fetch_assoc()["session_id"];

        // REDIRECT IF CURRENT SESSION ID DOES NOT MATCH SESSION ID IN DB 
        if ($_SESSION["session_id"] !== $userSession) {
            header("location: /final_project/login.php");
            exit(0);
        }

        // IF THE SESSION ID IS CORRECT REDIRECT TO MAIN PAGE
    }
}
