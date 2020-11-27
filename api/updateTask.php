<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

// Process get requests
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $result = DB::run("select * from `user_tasks` where id = '$id'")->fetch_all(MYSQLI_ASSOC);
    $jsonOutput = json_encode($result);
    echo $jsonOutput;
    exit(0);
}

class UpdateTask {
    public function execute() {
        $data = json_decode(file_get_contents('php://input'), true);
        extract($data);
        $sql = "INSERT INTO `user_tasks` (`user_id`, `description`) VALUES ('$user_id', '$description')";
        DB::run($sql);
    }
}

(new UpdateTask)->execute();