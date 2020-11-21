<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

class DoItContents {
    public $userId;
    public $username;

    function __construct($userId) {
        $this->userId = $userId;
        $username = DB::run("SELECT `user_name` FROM `users` WHERE `user_id` = '$this->userId'")->fetch_assoc()["user_name"];
        $this->username = $username;
    }

    public function getUserName(){
        return $this->username;
    }

    public function displayName(){
        ?>

        <?php if($this->getUserName()) : ?>
            <h1 style="text-align: center; margin:150px 0"> Hello&nbsp<?= $this->getUserName() ?> </h1>
        <?php endif; ?>

        <?php
    }
    
}