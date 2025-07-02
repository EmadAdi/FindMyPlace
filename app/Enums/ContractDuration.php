<?php

namespace App\Enums;

enum ContractDuration: string
{
    case MONTHLY = 'Monthly';
    case ANNUAL = 'Annual';
    case TEMPORARY = 'Temporary';
}
