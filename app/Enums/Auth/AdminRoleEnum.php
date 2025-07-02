<?php

namespace App\Enums\Auth;

 enum AdminRoleEnum: string
{
    case ADMIN = 'admin';

    public function guard(): string
    {
        return 'admin';
    }
}

