<?php
require_once __DIR__ . '/../config/Database.php';

class Task {
    private $conn;
    private $table = "tasks";

    public $title;
    public $description;
    public $due_date;
    public $created_by;
    public $assigned_to;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crearTask() {
        $query = "INSERT INTO {$this->table} (title, description, due_date, created_by, assigned_to)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        $this->created_by = intval($this->created_by);
        $this->assigned_to = intval($this->assigned_to);

        $stmt->bindParam(1, $this->title);
        $stmt->bindParam(2, $this->description);
        $stmt->bindParam(3, $this->due_date);
        $stmt->bindParam(4, $this->created_by);
        $stmt->bindParam(5, $this->assigned_to);

        return $stmt->execute();
    }

    // Obtener tareas creadas por un administrador
    public function getTasksAdmin($adminId) {
        $query = "SELECT t.id, t.title, t.description, t.due_date, t.created_by, t.assigned_to, u.name FROM {$this->table} t INNER JOIN users u ON t.assigned_to  = u.id WHERE created_by = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $adminId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener tareas asignadas a un ejecutor
    public function getTasksEjecutor($userId) {
        $query = "SELECT * FROM {$this->table} WHERE assigned_to = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
