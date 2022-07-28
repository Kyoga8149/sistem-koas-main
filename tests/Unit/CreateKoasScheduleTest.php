<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Group;
use App\Enums\StudyType;
use App\Models\Enums\GroupStatus;
use Database\Seeders\SanjiwaniSeeder;
use App\Actions\Groups\CreateKoasSchedule;
use App\Exceptions\InvalidStatusException;

class CreateKoasScheduleTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SanjiwaniSeeder::class);
    }

    public function test_cannot_create_if_status_incorrect()
    {
        foreach (GroupStatus::cases() as $status) {
            if ($status === GroupStatus::StudentAssigned) {
                continue;
            }
            try {
                $group = Group::factory()->create([
                    'status' => $status,
                ]);
                CreateKoasSchedule::run($group);
                $this->fail("Should not be able to create group schedule for group with status {$status}");
            } catch (InvalidStatusException $e) {
                $this->assertTrue(true);
            }
        }
    }

    public function test_cannot_create_if_study_type_is_not_koas()
    {
        foreach (StudyType::cases() as $type) {
            if ($type === StudyType::Clerkship) {
                continue;
            }

            try {
                $group = Group::factory()->create([
                    'study_type' => $type,
                    'status' => GroupStatus::StudentAssigned,
                ]);
                CreateKoasSchedule::run($group);
                $this->fail("Should not be able to create group schedule for group with study type {$type->value}");
            } catch (InvalidStatusException $e) {
                $this->assertTrue(true);
            }
        }
    }

    public function test_status_is_updated_when_creating_schedule()
    {
        $group = Group::factory()->create([
            'study_type' => StudyType::Clerkship,
            'status' => GroupStatus::StudentAssigned,
        ]);
        CreateKoasSchedule::run($group);
        $this->assertEquals(GroupStatus::StationsScheduled, $group->status);
    }

    public function test_will_create_the_schedule_for_koas()
    {
        $group = $this->createValidGroup();
        CreateKoasSchedule::run($group);

        $this->assertEquals(11, $group->stations()->count());
    }

    private function createValidGroup(): Group
    {
        return Group::factory()->create([
            'study_type' => StudyType::Clerkship,
            'status' => GroupStatus::StudentAssigned,
        ]);
    }
}
