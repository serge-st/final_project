<?php
require_once "./controllers/app.php";

RunApp::sessionVerifyController();
RunApp::header();
RunApp::doItDataController();
RunApp::mainSection();
RunApp::logoutController();
RunApp::footer();