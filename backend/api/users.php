<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

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
