<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum PaymentStatusEnum:string
{
    use InvokableCases;
    use Values;

    case PENDING = "pending";
    case PROCESSING = "processing";
    case COMPLETED = "completed";
    case DECLINE = "decline";
}
