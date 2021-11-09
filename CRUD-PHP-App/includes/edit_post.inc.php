<?php

include "functions.inc.php";
include "../classes/blogposts.classes.php";
session_start();

if (
    isset($_POST["submit"]) &&
    isset($_SESSION["username"]) &&
    authorMatchesPost($_SESSION["username"], $_POST["postID"]) &&
    CSRFTokenOK($_POST["csrf_token"])
) {
    removeCSRFToken();

    $postController = new BlogpostController($_SESSION["username"]);

    $newTitle = $_POST["postTitle"];
    $newBody = $_POST["postBody"];
    $postID = $_POST["postID"];

    $postController->editPost($newTitle, $newBody, $postID);

    header("location: ../index.php?message=edited_post");
    
} else {
    removeCSRFToken();
    header("location: ../login.php");
    exit();
}