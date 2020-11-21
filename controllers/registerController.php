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

    public function processRegister($globalPostVariable) {
        // checking if the required fields are set:
        if (!empty($globalPostVariable["email"]) && !empty($globalPostVariable["password"]) && !empty($globalPostVariable["username"])) {
            // setting auth token and hashing algorithm
            $this->setTokens();
            // collecting all the required fields
            $email = $globalPostVariable["email"];
            $username = $globalPostVariable["username"];
            $userId = md5($email);
            // processing password
            $password = hash_hmac($this->hashAlgo, $globalPostVariable["password"], $this->authToken);
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

            // TODO show success message (in JS or form.php);
            // TODO check if the user already exists??? (possibli query db api with fetch on input email keyup)
            // TODO create uses and redirect to login page
        } else {
            // TODO implement error handling
            exit(0);
        }
    }
}