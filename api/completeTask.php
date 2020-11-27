<?php

require_once __DIR__ . "/../helpers/db_wrapper.php";

// Process checkboxes
$data = json_decode(file_get_contents('php://input'), true);
extract($data);
$sql = "UPDATE `user_tasks` SET is_completed = $is_completed WHERE id = $id";
DB::run($sql);