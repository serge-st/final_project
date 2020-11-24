<?php
require_once "./controllers/app.php";

RunApp::sessionVerifyController();

// IF SESSION WAS CREATED LOAD APP:
RunApp::header();
// TODO querry user data
// TODO display user name
RunApp::doItDataController();

// TODO display user data
RunApp::mainSection();
// TODO logout button

// LOGOUT FUNCTIONALITY
RunApp::logoutController();
RunApp::footer();


