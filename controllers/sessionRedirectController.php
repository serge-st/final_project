<?php

class SessionRedirectController {
    public function activate(){
        session_start();

        if (empty($_SESSION)){
            return;
        }

        header("location: /final_project/index.php");
    }
}