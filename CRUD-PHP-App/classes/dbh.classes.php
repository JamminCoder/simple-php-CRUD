<?php

class DBH {
    public string $dbUsername;
    public string $dbPassword;
    public string $dbHost;
    public string $dbName;
    
    public function __construct($dbUsername, $dbPassword, $dbHost, $dbName) {
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
    }

    public function connect() {
        try {
            // Create new database handler with PDO
            $dbh = new PDO(
                "mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, 
                $this->dbUsername, $this->dbPassword
            );
            
            return $dbh;

        } catch (PDOException $e) {
            print "USERNAME: " . $this->dbUsername . "<br>";
            print "ERROR:<br><br>" . $e->getMessage() . "\n";
            die();
        }
    }
}


$dbUsername = "DATABASE_USERNAME";
$dbPassword = "DATABASE_PASSWORD";
$dbHost = "localhost"; // Database host
$dbName = "blog_database"; // Database name

$dbh = new DBH($dbUsername, $dbPassword, $dbHost, $dbName);
