<?php

namespace App\Actions\Groups;

use App\Models\Group;
use App\Models\Enums\GroupStatus;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Exceptions\InvalidStatusException;

class ExpireGroup
{
    use AsAction;

    public function handle(Group $group)
    {
        if ($group->status !== GroupStatus::Started) {
            throw new InvalidStatusException('Invalid Status');
        }

        $group->status = GroupStatus::Finished;
        $group->save();
    }
}
