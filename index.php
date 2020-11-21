<?php
require_once "./controllers/app.php";

session_start();
// IF SESSION ID WAS NOT CREATED:
// redirect
if (empty($_SESSION["session_id"])) {
    // querry DB for user and session
    header("location: /final_project/login.php");
}

// IF SESSION WAS CREATED LOAD APP:
var_dump($_SESSION);

// querry user data
// display user name
// display user data
// logout button

// LOGOUT FUNCTIONALITY
if (isset($_POST["logout"])){
    // delete session from DB
    $_SESSION = array();
    session_destroy();
    header("location: /final_project/login.php");
}
?>

<?= RunApp::header(); ?>

<div style="text-align: center; margin: 100px;">
<h1>HELLO ELINA WELCOME TO THE TO DO APP</h1>

<table style="display: block; width: 500px; margin: 50px auto;">
    <thead>
        <tr>
            <th>TASK</th><th>IS COMPLETE?</th>
        </tr>
    </thead>

    <tbody>
        <tr> <td>asfdsadf</td><td><input type="checkbox" name="" id=""> </td> </tr>
        <tr> <td>asfdsadf</td><td><input type="checkbox" name="" id=""> </td> </tr>
        <tr> <td>asfdsadf</td><td><input type="checkbox" name="" id=""> </td> </tr>
        <tr> <td>asfdsadf</td><td><input type="checkbox" name="" id=""> </td> </tr>
        <tr> <td>asfdsadf</td><td><input type="checkbox" name="" id=""> </td> </tr>
        <tr> <td>asfdsadf</td><td><input type="checkbox" name="" id=""> </td> </tr>
        <tr> <td>asfdsadf</td><td><input type="checkbox" name="" id=""> </td> </tr>
        <tr> <td>asfdsadf</td><td><input type="checkbox" name="" id=""> </td> </tr>
    </tbody>
</table>

<form method="POST">
    <input type="hidden" name="logout">
    <button type="submit">Logout</button>
</form>
</div>


<?= RunApp::footer(); ?>