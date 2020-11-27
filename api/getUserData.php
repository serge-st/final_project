<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

class GetUserData {
    public function execute() {
        if (empty($_GET["user_id"])) {
            exit("User ID must be included");
        }
        $userId = $_GET["user_id"];
        $result = DB::run("SELECT * FROM `user_tasks` WHERE `user_id` = '$userId'")->fetch_all(MYSQLI_ASSOC);
        echo json_encode($result);
    }
}

(new GetUserData)->execute();