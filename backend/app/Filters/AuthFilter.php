<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine("Authorization");

        if (!$header) {
            return service('response')->setJSON([
                'status' => 401,
                'message' => 'Token required'
            ]);
        }

        try {
            $token = explode(" ", $header)[1];
            $key = getenv('JWT_SECRET');

            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // ✅ You can access user data if needed
            // $decoded->data

        } catch (\Exception $e) {
            return service('response')->setJSON([
                'status' => 401,
                'message' => 'Invalid or expired token'
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing needed
    }
}