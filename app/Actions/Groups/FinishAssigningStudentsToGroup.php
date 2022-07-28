<?php

namespace App\Actions\Groups;

use App\Exceptions\InvalidStatusException;
use App\Models\Group;
use App\Models\Enums\GroupStatus;
use Lorisleiva\Actions\Concerns\AsAction;

class FinishAssigningStudentsToGroup
{
    use AsAction;

    public function handle(Group $group): Group
    {
        if ($group->status !== GroupStatus::New) {
            throw new InvalidStatusException("Status is not new");
        }

        $group->status = GroupStatus::StudentAssigned;
        $group->save();

        return $group;
    }
}
