<?php

namespace App\Enum\Course;

use App\Enum\EnumAction;

enum DiffEnum: string
{
    use EnumAction;

    case BEGINNER = 'beginner';
    case INTERMEDIATE = 'intermediate';
    case ADVANCED = 'advanced';
}
