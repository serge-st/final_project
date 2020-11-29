<?php
require_once __DIR__ . "/controllers/app.php";

RunApp::sessionRedirectController();
RunApp::header();
RunApp::login();
RunApp::footer();
RunApp::loginController();