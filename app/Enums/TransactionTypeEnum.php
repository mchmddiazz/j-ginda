<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum TransactionTypeEnum:string
{
    use InvokableCases;
    use Values;

    case OUT = "out";
    case IN = "in";
    case DECLINE = "decline";
}
