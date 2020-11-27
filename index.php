<?php
require_once "./controllers/app.php";

RunApp::sessionVerifyController();

// IF SESSION WAS CREATED LOAD APP:
RunApp::header();
RunApp::doItDataController();
RunApp::mainSection();
RunApp::logoutController();
RunApp::footer();


