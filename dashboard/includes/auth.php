<?php
require_once __DIR__ . '/../helpers/jwt.php';

class AuthMiddleware {
    public static function verificarToken() {
        // Leer token desde cookie, no desde headers
        if (!isset($_COOKIE['token'])) {
            header("Location: login.php");
            exit();
        }

        $token = $_COOKIE['token'];
        $payload = verificarToken($token);

        if (!$payload) {
            header("Location: login.php");
            exit();
        }

        return $payload->data; // id, email, role
    }

    public static function soloAdmin($payload) {
        if ($payload->role != 1) {
            header("Location: login.php");
            exit();
        }
    }

    public static function soloEjecutor($payload) {
        if ($payload->role != 2) {
            header("Location: login.php");
            exit();
        }
    }
}
