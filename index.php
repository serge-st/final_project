<?php
require_once "./controllers/app.php";

RunApp::verifySession();

// IF SESSION WAS CREATED LOAD APP:
RunApp::header();
// TODO querry user data
RunApp::displayUserData($_SESSION["user_id"]);
var_dump($_SESSION["user_id"]);
// TODO display user name
// TODO display user data
// TODO logout button

// LOGOUT FUNCTIONALITY
RunApp::logoutController();
RunApp::footer();


