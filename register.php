<?php
require_once "./controllers/app.php";

RunApp::header();
RunApp::register();
RunApp::footer();
if (RunApp::loginRegisterController($_POST)){
    header("location: /final_project/login.php");
};