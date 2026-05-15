<?php

class Participation {

    private $conn;

    private $table = "participations";

    public $id;
    public $team_id;
    public $tournament_id;

    public function __construct($db) {

        $this->conn = $db;
    }

    // Join Tournament
    public function joinTournament() {

        $query = "INSERT INTO " . $this->table . "
                  (team_id, tournament_id)
                  VALUES
                  (:team_id, :tournament_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':team_id', $this->team_id);
        $stmt->bindParam(':tournament_id', $this->tournament_id);

        if($stmt->execute()) {

            return true;
        }

        return false;
    }

    // Read participations
    public function readAll() {

        $query = "SELECT * FROM " . $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}
?>