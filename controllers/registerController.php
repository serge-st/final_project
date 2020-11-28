<?php
require_once __DIR__ . "/../helpers/db_wrapper.php";

class RegisterController {
    // change to private
    private $authToken;
    private $hashAlgo;

    private function setTokens(){
        $this->authToken = parse_ini_file(__DIR__ . '/../config.ini')["auth.token"];
        $this->hashAlgo = parse_ini_file(__DIR__ . '/../config.ini')["auth.hash_algo"];
    }

    public function processRegister() {
        // checking if the required fields are set:
        if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["username"])) {
            // setting auth token and hashing algorithm
            $this->setTokens();
            // collecting all the required fields
            $email = $_POST["email"];
            $username = $_POST["username"];
            $userId = md5($email);
            // processing password
            $password = hash_hmac($this->hashAlgo, $_POST["password"], $this->authToken);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // call to DB
            if (DB::run("SELECT `user_id` FROM users WHERE email='$email'")->num_rows === 0){
                DB::run("INSERT INTO `users` VALUES ('$userId', '$email', '$username', '$hashedPassword')");
                // remove when a better solution is complete
                header("location: /final_project/login.php");
            } else {
                // remove when a better solution is complete
                echo "user exists";
            };

        } else {
            // TODO implement error handling
            exit(0);
        }
    }
}