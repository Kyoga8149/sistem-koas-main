<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Group;
use App\Models\Enums\GroupStatus;
use App\Actions\Groups\ReturnGroupStudents;
use App\Exceptions\InvalidStatusException;
use App\Models\StationGroup;
use App\Models\Enums\StationGroupStatus;
use Exception;

class ReturnGroupStudentsTest extends TestCase
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
                ReturnGroupStudents::run($group);
                $this->fail("Should not be able to expire group with status {$status->value}");
            } catch (InvalidStatusException $e) {
                $this->assertTrue(true);
            }
        }
    }

    public function test_can_return_students()
    {
        $group = Group::factory()->create([
            'status' => GroupStatus::Started,
        ]);
        $dones = StationGroup::factory()->count(4)->create([
            'group_id' => $group->id,
            'status' => StationGroupStatus::Done,
        ]);

        ReturnGroupStudents::run($group);

        $this->assertEquals(GroupStatus::Finished, $group->status);
    }

    public function test_cannot_return_students_if_all_assigned_stations_not_done()
    {
        $group = Group::factory()->create([
            'status' => GroupStatus::Started,
        ]);

        $notDone = StationGroup::factory()->create([
            'status' => StationGroupStatus::InProgress,
            'group_id' => $group->id,
        ]);
        $dones = StationGroup::factory()->count(4)->create([
            'group_id' => $group->id,
            'status' => StationGroupStatus::Done,
        ]);

        try {
            ReturnGroupStudents::run($group);
            $this->assertTrue(false, 'Should not be able to return students if all stations not done');
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
    }
}
