<?php

include "functions.inc.php";
include "../classes/blogposts.classes.php";

session_start();

if (
    isset($_SESSION["username"]) &&
    isset($_POST["submit"]) &&
    CSRFTokenOK($_POST["csrf_token"])
) {
    removeCSRFToken();
    $postTitle  = $_POST["postTitle"];
    $postBody = $_POST["postBody"];
    $postID = genRandomString(16);

    $postController = new BlogpostController($_SESSION["username"]);

    $postController->createPost($postTitle, $postBody, $postID);
    header("location: ../index.php?message=post_submitted");
    exit();
} 
else {
    removeCSRFToken();
    header("location: ../login.php$message");
    exit();
}

