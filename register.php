<?php
require_once "./controllers/app.php";

RunApp::sessionRedirectController();
RunApp::header();
RunApp::register();
RunApp::footer();
RunApp::registerController();