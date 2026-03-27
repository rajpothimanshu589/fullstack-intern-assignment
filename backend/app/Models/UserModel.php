<?php

namespace App\Models;              // ✅ REQUIRED

use CodeIgniter\Model;            // ✅ REQUIRED

class UserModel extends Model
{
    protected $table = 'auth_user';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role'
    ];
}