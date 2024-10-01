<?php

namespace App\Enum\Skill;

use App\Enum\EnumAction;

enum TypeEnum: string
{
    use EnumAction;

    case TECHNOLOGY = 'technology';
    case DESIGN = 'design';
    case MANAGEMENT = 'management';
    case LANGUAGE = 'language';
}
