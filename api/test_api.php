<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

$userId = $_GET["user_id"];

// method to use with list display:
$result = DB::run("select * from `user_tasks` where user_id = '$userId'")->fetch_all(MYSQLI_ASSOC);

$jsonOutput = json_encode($result);

echo $jsonOutput;