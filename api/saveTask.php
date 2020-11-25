<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

class SaveTask {
    public function execute() {
        $data = json_decode(file_get_contents('php://input'), true);
        extract($data);
        $sql = "INSERT INTO `user_tasks` (`user_id`, `description`) VALUES ('$user_id', '$description')";
        DB::run($sql);
    }
}

(new SaveTask)->execute();