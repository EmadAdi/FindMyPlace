<?php

namespace App\Enums\Auth;


enum UserRoleEnum: string
{
    case USER = 'user';

    public function guard(): string
    {
        return 'user';
    }
}
