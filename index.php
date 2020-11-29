<?php
require_once __DIR__ . "/controllers/app.php";

RunApp::sessionVerifyController();
RunApp::header();
RunApp::doItDataController();
RunApp::mainSection();
RunApp::logoutController();
RunApp::footer();