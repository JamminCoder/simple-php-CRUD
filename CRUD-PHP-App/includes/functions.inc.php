<?php


include "dbh.inc.php";
session_start();

function genRandomString($strLength) {
    $chars = "abcdefghijklmnopqrstuvwxyz1234567890";
    $randStr = "";

    for ($i = 0; $i < $strLength; $i++) {
        $index = rand(0, strlen($chars) - 1);
        $randStr .= $chars[$index];
    }
    return $randStr;
}




function userExists($identifier) {
    $query = "SELECT * FROM accounts WHERE username = (:identifier) OR email = (:identifier) OR user_id = (:identifier);";
    $stmt = $GLOBALS["dbConn"]->prepare($query);

    $stmt->execute([
        "identifier" => $identifier
    ]);

    $returnedRow = $stmt->fetch();

    if ($returnedRow && !empty($returnedRow["username"])) {
        return true;
    } else {
        return false;
    }
}


function getPosts() {
    $query = "SELECT * FROM posts;";
    $stmt = $GLOBALS["dbConn"]->prepare($query);

    $stmt->execute();

    $rows = $stmt->fetchAll();

    if ($rows) {
        return $rows;
    } else {
        return false;
    }
}

function getPostByID($postID) {
    $query = "SELECT * FROM posts WHERE post_id = (:post_id);";

    $stmt = $GLOBALS["dbConn"]->prepare($query);

    $stmt->execute([
        "post_id" => htmlspecialchars($postID)
    ]);

    $row = $stmt->fetch();

    if ($row) {
        return $row;
    } else {
        return false;
    }
}

// Security

function verifyPassword($username, $password) {
    $query = "SELECT * FROM accounts WHERE username = (:username);";
    $stmt = $GLOBALS["dbConn"]->prepare($query);

    $stmt->execute([
        "username" => $username
    ]);

    $returnedRow = $stmt->fetch();

    $hash = $returnedRow["password"];

    if (password_verify($password, $hash)) {
        return true;
    } else {
        return false;
    }
}


function validUsername($username) {
    return preg_match("/^[a-zA-Z0-9_]+$/", $username);
}


function authorMatchesPost($postAuthor, $postID) {
    $query = "SELECT * FROM posts WHERE post_id = (:post_id) AND post_author = (:post_author);";
    $stmt = $GLOBALS["dbConn"]->prepare($query);
    $stmt->execute([
        "post_id" => htmlspecialchars($postID),
        "post_author" => htmlspecialchars($postAuthor)
    ]);

    $row = $stmt->fetch();

    if ($row) {
        return $row;
    } else {
        return false;
    }
}

function generateCSRFToken() {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    return $_SESSION["csrf_token"];
}

// Sets a new CSRF token on the session.
function CSRFTokenOK($token) {
    if (
        isset($_SESSION["csrf_token"]) &&
        !empty($_SESSION["csrf_token"]) &&
        $_SESSION["csrf_token"] === $token
    ) {
        return true;
    } else {
        return false;
    }
}

function removeCSRFToken() {
    unset($_SESSION["csrf_token"]);
}
