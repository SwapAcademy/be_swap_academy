<?php

namespace App\Enum\Transaction;

use App\Enum\EnumAction;

enum TypeEnum: string
{
    use EnumAction;

    case EARNED = 'earned';
    case SPENT = 'spent';
}
