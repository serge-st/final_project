<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";
require_once __DIR__ . "/../components/modal.php";

class LoginController {
    private $authToken;
    private $hashAlgo;
    private $sessToken;

    private function setTokens(){
        $this->authToken = parse_ini_file(__DIR__ . '/../config.ini')["auth.token"];
        $this->hashAlgo = parse_ini_file(__DIR__ . '/../config.ini')["auth.hash_algo"];
        $this->sessToken = parse_ini_file(__DIR__ . '/../config.ini')["session.token"];
    }

    public function processLogin() {
        // checking if the required fields are set:
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $email = $_POST["email"];

            // Call DB to check if user exists
            $result = DB::run("SELECT `password`, `user_id` FROM `users` WHERE email='$email'")->fetch_assoc();

            // Check if passwords match
            if ($result) {
                $this->setTokens();
                $password = hash_hmac($this->hashAlgo, $_POST["password"], $this->authToken);
            } else {
                $errorPopUp = new PopUpModal;
                $errorPopUp->setMessage("Incorrect User or Password");
                $errorPopUp->setCloseManually(true);
                $errorPopUp->html();
                unset($_POST);
                exit(0);
            }
            
            if (password_verify($password, $result["password"])) {

            } else {
                $errorPopUp = new PopUpModal;
                $errorPopUp->setMessage("Incorrect User or Password");
                $errorPopUp->setCloseManually(true);
                $errorPopUp->html();
                unset($_POST);
                exit(0);
            }

            // start sesstion
            session_start();

            // set session tokens
            $sessionId = hash_hmac($this->hashAlgo, time(), $this->sessToken);
            $sessionStartTime = date('Y-m-d_H:i:s');
            $userId = $result["user_id"];

            $_SESSION["user_id"] = $userId;
            $_SESSION["session_id"] = $sessionId;
            $_SESSION["startTime"] = $sessionStartTime;

            // If session exists delete the old one
            if (DB::run("SELECT * FROM `user_sessions` WHERE `user_id` = '$userId'")->num_rows) {
                DB::run("DELETE FROM `user_sessions` WHERE `user_id` = '$userId')");
            }

            // create session record in DB
            DB::run("INSERT into `user_sessions` VALUES ('$sessionId', '$userId')");

            // redirect to the main app page
            header("location: /final_project/index.php");

        } else {
            unset($_POST);
            exit(0);
        }
    }
}