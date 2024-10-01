<?php

namespace App\Enum\User;

use App\Enum\EnumAction;

enum BadgeEnum: string
{
    use EnumAction;

    case BRONZE = 'bronze';
    case SILVER = 'silver';
    case GOLD = 'gold';
    case PLATINUM = 'platinum';
}
