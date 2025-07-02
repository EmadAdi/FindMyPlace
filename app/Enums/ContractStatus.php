<?php

namespace App\Enums;

enum ContractStatus: string
{
    case OPEN = 'Open';
    case CLOSED = 'Closed';
    case CANCELLED = 'Cancelled';
}
