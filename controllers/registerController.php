<?php
require_once __DIR__ . "/../helpers/db_wrapper.php";
require_once __DIR__ . "/../components/modal.php";

class RegisterController {
    private $authToken;
    private $hashAlgo;

    private function setTokens(){
        $this->authToken = parse_ini_file(__DIR__ . '/../config.ini')["auth.token"];
        $this->hashAlgo = parse_ini_file(__DIR__ . '/../config.ini')["auth.hash_algo"];
    }

    public function processRegister() {
        if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["username"])) {
            $this->setTokens();

            $email = $_POST["email"];
            $username = $_POST["username"];
            $userId = md5($email);

            $password = hash_hmac($this->hashAlgo, $_POST["password"], $this->authToken);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // calls to DB
            if (DB::run("SELECT `user_id` FROM users WHERE email='$email'")->num_rows === 0){
                // insert new user
                DB::run("INSERT INTO `users` VALUES ('$userId', '$email', '$username', '$hashedPassword')");

                $successPopUp = new PopUpModal;
                $successPopUp->setMessage("User Created!");
                $successPopUp->html();
                
                // redirect user
                header("refresh:1; url=/final_project/login.php");
            } else {
                $errorPopUp = new PopUpModal;
                $errorPopUp->setMessage("User Already Exists");
                $errorPopUp->setCloseManually(true);
                $errorPopUp->html();
            };

        } else {
            exit(0);
        }
    }
}