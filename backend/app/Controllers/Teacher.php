<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Teacher extends BaseController
{
    // ✅ CREATE USER + TEACHER (FINAL)
    public function createWithUser()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $userModel = new \App\Models\UserModel();
        $teacherModel = new \App\Models\TeacherModel();

        $data = $this->request->getJSON(true);

        // ✅ Validation
        if (
            empty($data['email']) ||
            empty($data['first_name']) ||
            empty($data['last_name']) ||
            empty($data['password'])
        ) {
            return $this->response->setJSON([
                'status' => 400,
                'message' => 'Missing required fields'
            ]);
        }

        // ✅ Check duplicate email
        $existingUser = $userModel->where('email', $data['email'])->first();

        if ($existingUser) {
            return $this->response->setJSON([
                'status' => 400,
                'message' => 'Email already exists'
            ]);
        }

        // ✅ CREATE USER (FINAL FIX)
        $user = [
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => password_hash($data['password'], PASSWORD_DEFAULT),
            'role'       => 'teacher'
        ];

        $userModel->save($user);
        $user_id = $userModel->getInsertID();

        // ✅ CREATE TEACHER (FINAL FIX)
        $teacher = [
            'user_id'          => $user_id,
            'university_name'  => $data['university_name'] ?? null,
            'gender'           => $data['gender'] ?? null,
            'year_joined'      => $data['year_joined'] ?? null
        ];

        $teacherModel->save($teacher);

        $db->transComplete();

        return $this->response->setJSON([
            'status' => 200,
            'message' => 'User + Teacher created successfully'
        ]);
    }

    // ✅ GET ALL TEACHERS WITH USER DATA (FINAL)
    public function getTeachersWithUsers()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('teachers');

        $builder->select('
            teachers.id,
            auth_user.email,
            auth_user.first_name,
            auth_user.last_name,
            teachers.university_name,
            teachers.gender,
            teachers.year_joined
        ');

        $builder->join('auth_user', 'auth_user.id = teachers.user_id');

        $builder->orderBy('teachers.id', 'DESC');

        $data = $builder->get()->getResult();

        return $this->response->setJSON([
            'status' => 200,
            'data' => $data
        ]);
    }
}