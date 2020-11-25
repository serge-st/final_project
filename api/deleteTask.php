<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

class DeleteTask {
    public function execute(){
        $id = json_decode(file_get_contents('php://input'), true)["id"];
        $sql = "DELETE FROM `user_tasks` WHERE id = '$id'";
        DB::run($sql);
    }
}

(new DeleteTask)->execute();