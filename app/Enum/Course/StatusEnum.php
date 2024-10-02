<?php

namespace App\Enum\Course;

use App\Enum\EnumAction;

enum StatusEnum: string
{
    use EnumAction;

    case NOTSTARTED = 'not started';
    case INPROGGRESS = 'in proggress';
    case COMPLETED = 'completed';
}
