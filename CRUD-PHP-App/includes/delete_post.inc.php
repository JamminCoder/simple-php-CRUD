<?php

session_start();
include "dbh.inc.php";
include "functions.inc.php";



// Check to see if session username is the same as the author of post before deleting it!!
if (
    isset($_SESSION["username"]) &&
    authorMatchesPost($_SESSION["username"], $_POST["post_id"]) !== false &&
    CSRFTokenOK($_POST["csrf_token"])
) {
    removeCSRFToken();
    $query = "DELETE FROM posts WHERE post_id = (:post_id) AND post_author = (:post_author);";

    $stmt = $GLOBALS["dbConn"]->prepare($query);

    $stmt->execute([
        "post_id" => htmlspecialchars($_POST["post_id"]),
        "post_author" => htmlspecialchars($_SESSION["username"])
    ]);


    header("location: ../index.php?message=deleted_post");
    
} else {
    removeCSRFToken();
    header("location: ../login.php$message");
    exit();
}