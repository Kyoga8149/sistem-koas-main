<?php

namespace Tests\Unit;

use Notification;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Group;
use App\Models\Enums\GroupStatus;
use App\Actions\Groups\StartGroup;
use App\Exceptions\InvalidStatusException;
use App\Notifications\Groups\GroupStartedNotif;

class StartGroupTest extends TestCase
{

    public function test_cannot_start_if_status_incorrect()
    {
        foreach (GroupStatus::cases() as $status) {
            if ($status === GroupStatus::StationsScheduled) {
                continue;
            }
            try {
                $group = Group::factory()->create([
                    'status' => $status,
                ]);
                StartGroup::run($group);
                $this->fail("Should not be able to start group with status {$status->value}");
            } catch (InvalidStatusException $e) {
                $this->assertTrue(true);
            }
        }
    }

    public function test_can_start_group()
    {
        Notification::fake();

        $group = Group::factory()->create([
            'status' => GroupStatus::StationsScheduled,
        ]);
        Admin::factory()->count(2)->create();

        StartGroup::run($group);

        $this->assertEquals(GroupStatus::Started, $group->status);


        $admins = Admin::all();

        Notification::assertSentTo($admins, GroupStartedNotif::class);
    }
}
