<?php
require_once __DIR__ . "/controllers/app.php";

RunApp::sessionRedirectController();
RunApp::header();
RunApp::register();
RunApp::footer();
RunApp::registerController();