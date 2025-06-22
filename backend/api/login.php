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
require_once '../helpers/response.php';
require_once '../helpers/jwt.php';

$data = json_decode(file_get_contents("php://input"));

if (empty($data->email) || empty($data->password)) {
    jsonResponse(400, "Correo y contraseña son requeridos");
}

$db = (new Database())->connect();
$userModel = new User($db);

$user = $userModel->buscarPorCorreo($data->email);

if (!$user) {
    jsonResponse(401, "Correo no registrado");
}

if (!password_verify($data->password, $user['password'])) {
    jsonResponse(401, "Contraseña incorrecta");
}

$token = generarToken($user);

jsonResponse(200, "Inicio de sesión exitoso", [
    "token" => $token,
    "user" => [
        "id" => $user['id'],
        "name" => $user['name'],
        "email" => $user['email'],
        "role" => $user['role']
    ]
]);
