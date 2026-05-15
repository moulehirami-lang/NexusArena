<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database {

    private $host = "localhost";
    private $dbname = "nexus_arena";
    private $username = "root";
    private $password = "";

    public $conn;

    public function connect() {

        $this->conn = null;

        try {

            $this->conn = new PDO(
                "mysql:host=".$this->host.";dbname=".$this->dbname,
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch(PDOException $e) {

            echo "Erreur : " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>