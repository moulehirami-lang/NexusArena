<?php

(E_ALL);
ini_set('display_errors', 1);

class Team {

    // Connexion base de données
    private $conn;

    // Nom de la table
    private $table = "teams";

    // Attributs
    public $id;
    public $name;
    public $logo;
    public $captain_id;

    // Constructeurerror_reporting
    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE TEAM
    public function create() {

        $query = "INSERT INTO " . $this->table . "
                  (name, logo, captain_id)
                  VALUES
                  (:name, :logo, :captain_id)";

        $stmt = $this->conn->prepare($query);

        // Sécurité
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->logo = htmlspecialchars(strip_tags($this->logo));

        // Bind
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':logo', $this->logo);
        $stmt->bindParam(':captain_id', $this->captain_id);

        // Exécution
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // READ ALL TEAMS
    public function readAll() {

        $query = "SELECT * FROM " . $this->table . "
                  ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    // READ ONE TEAM
    public function readOne() {

        $query = "SELECT * FROM " . $this->table . "
                  WHERE id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->logo = $row['logo'];
        $this->captain_id = $row['captain_id'];
    }

    // UPDATE TEAM
    public function update() {

        $query = "UPDATE " . $this->table . "
                  SET
                  name = :name,
                  logo = :logo
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sécurité
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->logo = htmlspecialchars(strip_tags($this->logo));

        // Bind
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':logo', $this->logo);
        $stmt->bindParam(':id', $this->id);

        // Exécution
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // DELETE TEAM
    public function delete() {

        $query = "DELETE FROM " . $this->table . "
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>