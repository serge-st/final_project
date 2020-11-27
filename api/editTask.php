<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

class EditTask {
    public function execute() {
        if (empty($_GET["id"])) {
            exit("Task ID must be included");
        }
        $id = $_GET["id"];
        $result = DB::run("select * from `user_tasks` where id = '$id'")->fetch_all(MYSQLI_ASSOC);
        echo json_encode($result);
    }
}

(new EditTask)->execute();