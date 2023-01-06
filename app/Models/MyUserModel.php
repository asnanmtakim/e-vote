<?php

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel;

class MyUserModel extends UserModel
{
    protected $allowedFields  = [
        'username',
        'status',
        'status_message',
        'active',
        'last_active',
        'deleted_at',
        'gender',
        'first_name',
        'last_name',
        'image_user',
        'image_cover',
        'phone_number',
    ];

    public function getOneUser($user_id)
    {
        return $this->join('auth_identities', 'auth_identities.user_id = users.id AND auth_identities.type = "email_password"')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->where('users.id', $user_id)
            ->first();
    }
}
