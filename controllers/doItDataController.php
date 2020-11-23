<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

class DoItContents {
    public $userId;
    public $username;

    function __construct() {
            if (isset($_SESSION)) {
                $this->userId = $_SESSION["user_id"];
                $username = DB::run("SELECT `user_name` FROM `users` WHERE `user_id` = '$this->userId'")->fetch_assoc()["user_name"];
                $this->username = $username;
            }
    }

    public function getUserName(){
        return $this->username;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function displayName(){
        ?>

        <?php if($this->getUserName()) : ?>
            <h1 id="session-heading" user-id="<?= $this->getUserId() ?>"> Hello&nbsp<?= $this->getUserName() ?> </h1>
        <?php endif; ?>

        <?php
    }
    
}