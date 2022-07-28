<?php

namespace App\Actions\Groups;

use Exception;
use App\Models\Group;
use App\Models\Enums\GroupStatus;
use App\Models\Enums\StudentStatus;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Exceptions\InvalidStatusException;
use App\Models\Enums\StationGroupStatus;

class MarkGroupAsReady
{
    use AsAction;

    public function handle(Group $group)
    {
        if ($group->status !== GroupStatus::StationsScheduled) {
            throw new InvalidStatusException("Status is not scheduled");
        }

        // if there's no students, throw an exception.
        if ($group->students->count() < 1) {
            throw new Exception("There are no students in this group", 400);
        }

        // if students data is not complete, throw exception
        foreach ($group->students as $student) {
            if ($student->status !== StudentStatus::DataComplete) {
                throw new InvalidStatusException("Students data is not complete", 400);
            }
        }

        // if the first schedule is not ready, throw exception
        $firstStation = $group->stationGroups()->orderBy('start_date', 'asc')->first();
        if (!$firstStation) {
            throw new Exception("There are no assigned stations to this group", 400);
        }
        if ($firstStation->status !== StationGroupStatus::Scheduled) {
            throw new InvalidStatusException("First station is not scheduled", 400);
        }

        $group->status = GroupStatus::Ready;
        $group->save();
    }
}
