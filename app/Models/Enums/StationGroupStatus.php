<?php

namespace App\Models\Enums;

enum StationGroupStatus: string
{
    case New = 'new';
    case Scheduled = 'scheduled';
    case InProgress = 'in_progress';
    case Done = 'done';
}
