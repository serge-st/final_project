<?php
require_once "./controllers/app.php";

RunApp::verifySession();

// IF SESSION WAS CREATED LOAD APP:
RunApp::header();
// TODO querry user data
// TODO display user name
// TODO display user data
// TODO logout button

// LOGOUT FUNCTIONALITY
RunApp::logoutController($_POST, $_SESSION);
RunApp::footer();


