<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum RoleEnum: string
{
    use InvokableCases;
    use Values;

    case SUPERADMIN = "superadmin";
    case ADMINISTRATOR = "administrator";
    case USER = "user";
    case GUDANG = "gudang";
}
