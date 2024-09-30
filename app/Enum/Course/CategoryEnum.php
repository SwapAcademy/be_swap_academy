<?php

namespace App\Enum\Course;

use App\Enum\EnumAction;

enum CategoryEnum: string
{
    use EnumAction;

    case TECHNOLOGY = 'technology';
    case DESIGN = 'design';
    case MANAGEMENT = 'management';
}
