<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

class LoginController {
    // change to private
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
                // remove when a better solution is complete
                exit(0);
            }
            
            if (password_verify($password, $result["password"])) {
                // remove when a better solution is complete
            } else {
                // remove when a better solution is complete
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

            // create session record in DB
            DB::run("INSERT into `user_sessions` VALUES ('$sessionId', '$userId')");

            // redirect to the main app page
            // remove when a better solution is complete
            header("location: /final_project/index.php");

        } else {
            // TODO implement error handling
            exit(0);
        }
    }
}