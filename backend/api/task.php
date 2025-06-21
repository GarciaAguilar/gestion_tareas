<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once '../config/Database.php';
require_once '../models/Task.php';
require_once '../middleware/AuthMiddleware.php';
require_once '../helpers/response.php';

// Validar token
$payload = AuthMiddleware::verificarToken();
$db = (new Database())->connect();
$task = new Task($db);

// Obtener método
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Solo admins pueden crear tareas
        AuthMiddleware::soloAdmin($payload);

        $data = json_decode(file_get_contents("php://input"));

        if (
            empty($data->title) ||
            empty($data->description) ||
            empty($data->due_date) ||
            empty($data->assigned_to)
        ) {
            jsonResponse(400, "Todos los campos son requeridos");
        }

        $task->title = $data->title;
        $task->description = $data->description;
        $task->due_date = $data->due_date;
        $task->created_by = $payload->id;
        $task->assigned_to = $data->assigned_to;

        if ($task->crearTask()) {
            jsonResponse(201, "Tarea creada correctamente");
        } else {
            jsonResponse(500, "Error al crear la tarea");
        }

        break;

    case 'GET':
        if ($payload->role == 1) {
            $tasks = $task->getTasksAdmin($payload->id);
        } else {
            $tasks = $task->getTasksEjecutor($payload->id);
        }

        jsonResponse(200, "Tareas encontradas", $tasks);
        break;

    default:
        jsonResponse(405, "Método no permitido");
}
