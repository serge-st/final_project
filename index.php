<?php
require_once "./controllers/app.php";

session_start();
// IF SESSION ID WAS NOT CREATED:
// redirect
if (empty($_SESSION["session_id"])) {
    // querry DB for user and session
    header("location: /final_project/login.php");
}

var_dump($_SESSION);

// IF SESSION WAS CREATED LOAD APP:
RunApp::header();
// TODO querry user data
// TODO display user name
// TODO display user data
// TODO logout button

// LOGOUT FUNCTIONALITY
RunApp::logoutController($_POST, $_SESSION);
RunApp::footer();


