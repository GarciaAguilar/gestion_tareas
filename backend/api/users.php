<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../config/Database.php';
require_once '../models/User.php';
require_once '../middleware/AuthMiddleware.php';
require_once '../helpers/response.php';

// Validar token y rol admin
$payload = AuthMiddleware::verificarToken();
AuthMiddleware::soloAdmin($payload);

// Conexión y carga de modelo
$db = (new Database())->connect();
$userModel = new User($db);

// Obtener lista de usuarios con rol 2 (ejecutores)
$executors = $userModel->getUsersRol(2);

jsonResponse(200, "Usuarios ejecutores encontrados", $executors);
