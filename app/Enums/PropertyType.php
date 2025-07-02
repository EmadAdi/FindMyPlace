<?php

namespace App\Enums;


enum PropertyType: string

{
    case APARTMENT = 'apartment';
    case VILLA = 'villa';
    case TOWNHOUSE = 'townhouse';
    case COMMERCIAL = 'commercial';
    case LAND = 'land';
}

