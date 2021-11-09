<?php

session_start();

if (isset($_SESSION["username"])) {
    session_destroy();
    header("location: index.php");
    exit();
}

header("location: index.php");