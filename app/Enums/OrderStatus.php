<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum OrderStatus:string
{
    use InvokableCases;
    use Values;

    case PENDING = "pending";
    case PROCESSING = "processing";
    case COMPLETED = "completed";
    case SENDING = "sending";
    case DECLINE = "decline";
}
