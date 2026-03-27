<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
    // ✅ REGISTER
    public function register()
    {
        $model = new UserModel();

        $data = $this->request->getJSON(true);

        // ✅ Validation (basic)
        if (
            empty($data['first_name']) ||
            empty($data['last_name']) ||
            empty($data['email']) ||
            empty($data['password']) ||
            empty($data['role'])
        ) {
            return $this->response->setJSON([
                'status' => 400,
                'message' => 'All fields are required'
            ]);
        }

        // ✅ Check duplicate email
        $existingUser = $model->where('email', $data['email'])->first();

        if ($existingUser) {
            return $this->response->setJSON([
                'status' => 400,
                'message' => 'Email already exists'
            ]);
        }

        // ✅ Save user
        $user = [
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'role'       => $data['role'],
            'password'   => password_hash($data['password'], PASSWORD_DEFAULT),
        ];

        $model->save($user);

        return $this->response->setJSON([
            'status' => 200,
            'message' => 'User Registered Successfully'
        ]);
    }

    // ✅ LOGIN
    public function login()
    {
        $model = new UserModel();
        $data = $this->request->getJSON(true);

        $user = $model->where('email', $data['email'])->first();

        // ❌ Invalid login
        if (!$user || !password_verify($data['password'], $user['password'])) {
            return $this->response->setJSON([
                'status' => 401,
                'message' => 'Invalid credentials'
            ]);
        }

        // 🔐 JWT secret
        $key = getenv('JWT_SECRET');

        // ✅ Payload
        $payload = [
            'iss' => "localhost",
            'iat' => time(),
            'exp' => time() + 3600,
            'data' => [
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role']
            ]
        ];

        // 🔐 Generate token
        $token = JWT::encode($payload, $key, 'HS256');

        // ✅ Response
        return $this->response->setJSON([
            'status' => 200,
            'token' => $token,
            'user' => [
                'id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role'],
                'first_name' => $user['first_name'],
                'last_name'  => $user['last_name']
            ]
        ]);
    }
}