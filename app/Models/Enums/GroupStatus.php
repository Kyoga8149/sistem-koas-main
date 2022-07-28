<?php

namespace App\Models\Enums;

enum GroupStatus: string
{
    case New = 'new';
    case StudentAssigned = 'student_assigned';
    case StationsScheduled = 'stations_scheduled';
    case Ready = 'ready';
    case Started = 'started';
    case Finished = 'finished';
    case StudensReturned = 'students_returned';
}
