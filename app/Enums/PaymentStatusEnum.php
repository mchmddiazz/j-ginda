<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum PaymentStatusEnum:string
{
    use InvokableCases;
    use Values;

    case WAITING = "waiting";
    case PAID= "paid";
    case COD= "cod";
    case EXPIRED= "expired";
    case REJECT= "reject";
}
