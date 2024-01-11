<?php

// Database.php
class Database {
    private static $instance;
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    private function __construct() {
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "projetPWEB";
        $this->connect();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("La connexion à la base de données a échoué : " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function escapeString($value) {
        return $this->conn->real_escape_string($value);
    }

    // Vous pouvez ajouter d'autres méthodes en fonction des besoins, par exemple pour gérer les transactions, etc.
}


?>