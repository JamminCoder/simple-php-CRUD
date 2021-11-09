<?php


include "../includes/dbh.inc.php";
include "../includes/functions.inc.php";

class SignupControler {
    public $dbConn;
    public string $error;

    public string $username;
    public string $email;
    public string $password;
    public string $confirmPassword;


    public function __construct($signupPostRequest) {
        if (!isset($signupPostRequest["submit"])) {
            header("location: ../signup.php");
            exit();
        }

        // Set $dbConn to $dbConnection included from includes/dbh.inc.php
        $this->dbConn = $GLOBALS["dbConn"];

        // Extract info from the $signupPostRequest
        $this->username = htmlspecialchars($signupPostRequest["username"]);
        $this->email = htmlspecialchars($signupPostRequest["email"]);
        $this->password = htmlspecialchars($signupPostRequest["password"]);
        $this->confirmPassword = htmlspecialchars($signupPostRequest["confirm_password"]);
    }

    // Generate random id of given length
    private function genUID($idLength) {
        $userID = genRandomString($idLength);
        $maxTrys = 5;
        $i = 0;

        while ($this->userIDExists($userID) && $i < $maxTrys) {
            $userID = genRandomString($idLength);
            $i++;
        }

        // If this fails to generate a unique user ID after 5 trys, redirect the user to the index page.
        if ($i == $maxTrys) {
            header("location: ../index.php?error=too_many_users");
            exit();
        }

        return $userID;
    }

    private function passwordIsOK() {
        $passwordLen = strlen($this->password);
        if (strlen($this->password) < 8) {
            $this->error = "password_too_short";
            return false;
        }
        else if ($this->password !== $this->confirmPassword) {
            $this->error = "passwords_dont_match";
            return false;
        }
        else {
            return true;
        }
    }

    private function userIDExists($userID) {
        if (userExists($userID)) {
            return true;
        } else {
            return false;
        }
    }

    private function usernameIsOK() {
        if (empty($this->username)) {
            $this->error = "empty_username";
            return false;
        }
        else if (!validUsername($this->username)) {
            $this->error = "invalid_username";
            return false;
        }
        else if (userExists($this->username)) {
            $this->error = "user_exists";
            return false;
        }
        else {
            return true;
        }
    }

    private function emailIsOK() {
        if (empty($this->email)) {
            $this->error = "email_empty";
            return false;
        }
        else if (userExists($this->email)) {
            $this->error = "email_exists";
            return false;
        }
        else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error = "invalid_email";
            return false;
        }
        else {
            return true;
        }
    }

    public function userInfoIsOK() {
        if ($this->usernameIsOK() &&
            $this->passwordIsOK() &&
            $this->emailIsOK()
        ) {
            return true;
        }
        return false;
    }

    public function signupUser() {
        $userID = $this->genUID(64);

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        // Database stuff
        $query = "INSERT INTO accounts (username, email, password, user_id) VALUES (:username, :email, :password, :user_id);";
        
        $stmt = $this->dbConn->prepare($query);

        $stmt->execute([
            "username" => $this->username,
            "email" => $this->email,
            "password" => $hashedPassword,
            "user_id" => $userID 
        ]);

        session_start();
        session_regenerate_id(); // Regenerate ID to avoid session hijacking
        session_name(genRandomString(32));
        $_SESSION["username"] = $this->username;
        header("location: ../index.php");
        exit();
    }
}