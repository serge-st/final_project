<?php
require_once "./form.php";

function runApp(){
    $form = new Form("login");
    // $form = new Form("register");
    $form->setHeading("Welcome&nbspTo DOIT&nbspApp");
    $form->html();




}
