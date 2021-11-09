<?php

if (isset($_POST["submit"])) {

    include "../classes/signup.classes.php";

    $signupHandler = new SignupControler($_POST);

    if ($signupHandler->userInfoIsOK()) {
        $signupHandler->signupUser();
        header("location: ../index.php");
    }
    else {
        $error = htmlspecialchars($signupHandler->error, ENT_QUOTES);
        header("location: ../signup.php?error=$error");
        exit();
    }

} else {
    header("location: ../signup.php");
    exit();
}
