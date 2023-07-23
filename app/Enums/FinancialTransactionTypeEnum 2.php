<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum FinancialTransactionTypeEnum:string
{
    use InvokableCases;
    use Values;

    case DEBIT = "debit";
    case CREDIT = "credit";
}
