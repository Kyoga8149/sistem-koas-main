<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Group;
use App\Models\Enums\GroupStatus;
use App\Actions\Groups\ExpireGroup;
use App\Exceptions\InvalidStatusException;

class ExpireGroupTest extends TestCase
{
    public function test_cannot_start_if_status_incorrect()
    {
        foreach (GroupStatus::cases() as $status) {
            if ($status === GroupStatus::Started) {
                continue;
            }
            try {
                $group = Group::factory()->create([
                    'status' => $status,
                ]);
                ExpireGroup::run($group);
                $this->fail("Should not be able to expire group with status {$status->value}");
            } catch (InvalidStatusException $e) {
                $this->assertTrue(true);
            }
        }
    }

    public function test_can_expire_group()
    {
        $group = Group::factory()->create([
            'status' => GroupStatus::Started,
        ]);

        ExpireGroup::run($group);

        $this->assertEquals(GroupStatus::Finished, $group->status);
    }
}
