<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once '../config/Database.php';
require_once '../models/User.php';
require_once '../helpers/response.php';

$data = json_decode(file_get_contents("php://input"));

if (
    empty($data->name) ||
    empty($data->email) ||
    empty($data->password) ||
    !isset($data->role)
) {
    jsonResponse(400, "Todos los campos son requeridos");
}

$db = (new Database())->connect();
$user = new User($db);

// Verificar si ya existe el email
if ($user->buscarPorCorreo($data->email)) {
    jsonResponse(400, "El correo ya está registrado");
}

// Encriptar la contraseña
$user->name = $data->name;
$user->email = $data->email;
$user->password = password_hash($data->password, PASSWORD_BCRYPT);
$user->role = $data->role;

if ($user->crear()) {
    jsonResponse(201, "Usuario registrado correctamente");
} else {
    jsonResponse(500, "Error al registrar el usuario");
}
