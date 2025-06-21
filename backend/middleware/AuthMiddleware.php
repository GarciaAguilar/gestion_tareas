<?php
require_once __DIR__ . '/../helpers/jwt.php';
require_once __DIR__ . '/../helpers/response.php';

class AuthMiddleware {
    public static function verificarToken() {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            jsonResponse(401, "Token no proporcionado");
        }

        $authHeader = $headers['Authorization'];
        if (!str_starts_with($authHeader, "Bearer ")) {
            jsonResponse(401, "Formato de token inválido");
        }

        $token = trim(str_replace("Bearer", "", $authHeader));

        $payload = verificarToken($token);
        if (!$payload) {
            jsonResponse(401, "Token inválido o expirado");
        }

        return $payload->data; // devuelve info del usuario: id, email, role
    }

    public static function soloAdmin($payload) {
        if ($payload->role != 1) {
            jsonResponse(403, "Acceso denegado: solo para administradores");
        }
    }

    public static function soloEjecutor($payload) {
        if ($payload->role != 2) {
            jsonResponse(403, "Acceso denegado: solo para ejecutores");
        }
    }
}
