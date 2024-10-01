<?php

namespace App\Enum\User;

use App\Enum\EnumAction;

enum RoleEnum: string
{
    use EnumAction;

    case ADMIN = 'admin';
    case USER = 'user';
}
