<?php

namespace App\Actions\Groups;

use Notification;
use App\Models\Admin;
use App\Models\Group;
use App\Models\Enums\GroupStatus;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Exceptions\InvalidStatusException;
use App\Notifications\Groups\GroupStartedNotif;

class StartGroup
{
    use AsAction;

    public function handle(Group $group)
    {
        if ($group->status !== GroupStatus::StationsScheduled) {
            throw new InvalidStatusException('Invalid Status');
        }

        $admins = Admin::all();
        Notification::send($admins, new GroupStartedNotif($group));

        $group->status = GroupStatus::Started;
        $group->save();
    }
}
