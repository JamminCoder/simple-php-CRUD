<?php


include "../includes/dbh.inc.php";
include "../includes/functions.inc.php";


class LoginController {
    public $dbConn;
    public string $error;

    public $username;
    public string $password;

    public function __construct($username, $password) {
        $this->username = htmlspecialchars($username);
        $this->password = htmlspecialchars($password);

        $this->dbConn = $GLOBALS["dbConn"];
    }

    public function login() {
        if (!userExists($this->username)) {
            $this->error = "no_user";
            header("location: ../signup.php?error=$this->error?name=$this->username");
            exit();
        } 
        else if (!verifyPassword($this->username, $this->password)) {
            $this->error = "wrong_password";
            header("location: ../login.php?error=$this->error");
            exit();
        }
        else {
            session_start();
            session_regenerate_id();
            session_name(genRandomString(32));
            $_SESSION["username"] = $this->username;
        }
    }
}