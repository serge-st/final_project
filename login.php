<?php
require_once "./controllers/app.php";

RunApp::header();
RunApp::displayUserData();
RunApp::login();
RunApp::footer();
RunApp::loginController();