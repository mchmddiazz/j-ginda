<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum RoleEnum: string
{
    use InvokableCases;
    use Values;

    case ADMINISTRATOR = "administrator";
    case USER = "user";
    case GUDANG = "gudang";
}
