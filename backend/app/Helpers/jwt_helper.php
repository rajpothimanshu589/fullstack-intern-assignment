<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateJWT($user)
{
    // ✅ direct key (no global)
    $key = "my_super_secret_key_very_long_123456789_secure_project";

    $payload = [
        "iss" => "localhost",
        "aud" => "localhost",
        "iat" => time(),
        "exp" => time() + 3600,
        "data" => $user
    ];

    return JWT::encode($payload, $key, 'HS256');
}

function validateJWT($token)
{
    // ✅ same key here
    $key = "my_super_secret_key_very_long_123456789_secure_project";

    return JWT::decode($token, new Key($key, 'HS256'));
}