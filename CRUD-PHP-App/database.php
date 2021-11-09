<?php

include "classes/dbh.classes.php";

$dbh = new DBH();

$conn = $dbh->connect();

$stmt = $conn->prepare(
        "INSERT INTO accounts (username, email, password, user_id) 
        VALUES (:username, :email, :password, :user_id);"
);

$stmt->execute([
        "username" => "tim",
        "password" => "insecure_pass",
        "email" => "jammincoderguy96@gmail.com",
        "user_id" => "jkads7lkj1240jdahadhad094jl"
]);


