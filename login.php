<?php
require_once "./controllers/app.php";

// RunApp::sessionRedirectController();
RunApp::header();
RunApp::login();
RunApp::footer();
RunApp::loginController();