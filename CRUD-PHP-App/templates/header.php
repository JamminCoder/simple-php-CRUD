<?php

session_start();


// php.ini settings

// SESSION SECURITY SETTINGS
ini_set("session.trans_sid_hosts", "http://phptesting.org");
ini_set("session.cookie_lifetime", 0);  // Informs the browser not to store session cookies to permanant storage.

ini_set("session.use_cookies", "On");
ini_set("session.use_only_cookies", "On");
ini_set("session.use_strict_mode", "On");

ini_set("session.cookie_httponly", "On" ); // Disallows cookies to be set with JavaScript
ini_set("session.cookie_secure", "On");
ini_set("session.cookie_samesite", "Strict");
ini_set("session.use_trans_sid", "Off");

ini_set("session.cache_limiter", "nocache");

ini_set("session.sid_length", "48");
ini_set("session.sid_bits_per_character", "8");
ini_set("session.save_path", "/tmp");



// Display any errors directly on the page.
// * This should be turned off in a production environment to avoid leaking sensitive data. Instead errors should just be checked from the error.log file.
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Blog</title>
    <link rel="stylesheet" href="../static/app.css" type="text/css">
</head>
<body>
    <?php
        if (isset($_SESSION["username"])) {
            echo 
            "<ul>
                <li><a href='logout.php'>Log out</a></li>
                <li><a href='create_post.php'>Create a post</a></li>
            </ul>";
        } else {
            echo "
            <h2>Log In to create, edit, delete, or comment on Posts</h2>
            <ul>
                <li><a href='login.php'>Log In</a></li>
                <li><a href='signup.php'>Sign Up</a></li>
            </ul>";
        }
    ?>
