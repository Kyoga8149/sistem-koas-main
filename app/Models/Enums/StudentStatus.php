<?php

namespace App\Models\Enums;

enum StudentStatus: string
{
    case New = 'new';
    case DataComplete = 'data_complete';
    case Inactive = 'inactive';
}
