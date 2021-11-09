<?php

session_start();

if (isset($_POST["submit"])) {
    include "../classes/login.classes.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $loginContr = new LoginController($username, $password);

    $loginContr->login();

    header("location: ../index.php?message=login_success");
    exit();

} else {
    header("location: ../login.php");
    exit();
}