<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

define('JWT_SECRET', 'superClave2025!@#'); // Clave temporal
define('JWT_ALGORITHM', 'HS256');

function generarToken($user) {
    $payload = [
        "iat" => time(),
        "exp" => time() + (60 * 60 * 24), // 24 horas
        "data" => [
            "id" => $user['id'],
            "email" => $user['email'],
            "role" => $user['role']
        ]
    ];

    return JWT::encode($payload, JWT_SECRET, JWT_ALGORITHM);
}

function verificarToken($token) {
    try {
        return JWT::decode($token, new Key(JWT_SECRET, JWT_ALGORITHM));
    } catch (Exception $e) {
        return null;
    }
}
