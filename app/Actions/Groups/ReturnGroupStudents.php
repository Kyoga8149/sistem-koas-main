<?php

namespace App\Actions\Groups;

use App\Models\Group;
use App\Models\Enums\GroupStatus;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Exceptions\InvalidStatusException;
use App\Models\Enums\StationGroupStatus;
use Exception;

class ReturnGroupStudents
{
    use AsAction;

    public function handle(Group $group)
    {
        if ($group->status !== GroupStatus::Started) {
            throw new InvalidStatusException('Invalid Status');
        }

        /** @var Student */
        $notDone = $group->stations()
            ->where('status', '!=', StationGroupStatus::Done)->get();
        if ($notDone->count() > 0) {
            throw new Exception('Not all stations are done', 400);
        }


        $group->status = GroupStatus::Finished;
        $group->save();
    }
}
