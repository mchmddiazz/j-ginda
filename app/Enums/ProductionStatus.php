<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum ProductionStatus:string
{
    use InvokableCases;
    use Values;

    case DONE = "done";
    case CANCEL = "cancel";
    case WAITING = "waiting";
}
