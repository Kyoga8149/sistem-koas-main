<?php

use Tests\TestCase;
use App\Models\Group;
use App\Actions\Groups\MarkGroupAsReady;
use App\Models\Enums\GroupStatus;
use Database\Seeders\SanjiwaniSeeder;
use App\Exceptions\InvalidStatusException;
use App\Models\Enums\StudentStatus;
use App\Models\StationGroup;
use App\Models\Enums\StationGroupStatus;
use App\Models\Student;

class MarkGroupAsReadyTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SanjiwaniSeeder::class);
    }

    private function createGroup(): Group
    {
        /** @var Group */
        $group = Group::factory()->create([
            'status' => GroupStatus::StationsScheduled,
        ]);

        $students = Student::factory()->count(2)->create([
            'status' => StudentStatus::DataComplete,
            'group_id' => $group->id,
        ]);

        $stations = StationGroup::factory()->count(2)->create([
            'group_id' => $group->id,
            'status' => StationGroupStatus::Scheduled,
        ]);


        return $group;
    }

    public function test_cannot_proceed_if_status_is_incorrect()
    {
        foreach (GroupStatus::cases() as $status) {
            if ($status === GroupStatus::StationsScheduled) {
                continue;
            }
            try {
                $group = Group::factory()->create([
                    'status' => $status,
                ]);
                MarkGroupAsReady::run($group);
                $this->fail("Should not be able to mark group as ready for group with status {$status}");
            } catch (InvalidStatusException $e) {
                $this->assertTrue(true);
            }
        }
    }

    public function test_status_is_updated_when_marking_as_ready()
    {
        $group = $this->createGroup();
        $group->status = GroupStatus::StationsScheduled;
        $group->save();

        MarkGroupAsReady::run($group);
        $this->assertEquals(GroupStatus::Ready, $group->status);
    }

    public function test_can_only_be_ready_if_students_data_is_complete()
    {
        $group = $this->createGroup();
        $this->assertEquals(2, $group->students->count());

        foreach ($group->students as $student) {
            $student->status = StudentStatus::New;
            $student->save();
            $this->assertEquals(StudentStatus::New, $student->status);
        }



        try {
            MarkGroupAsReady::run($group);
            $this->fail("Should not be able to mark group as ready if students data is incomplete");
        } catch (Exception $e) {
            $this->assertTrue(true);
        }

        /** @var Student $student */
        foreach ($group->students as $student) {
            $student->status = StudentStatus::DataComplete;
            $student->save();
        }

        MarkGroupAsReady::run($group);

        $this->assertEquals(GroupStatus::Ready, $group->status);
        foreach ($group->students as $student) {
            $this->assertEquals(StudentStatus::DataComplete, $student->status);
        }
    }

    public function test_cannot_mark_as_ready_if_first_station_is_not_ready()
    {
        /** @var Group */
        $group = Group::factory()->create([
            'status' => GroupStatus::StationsScheduled,
        ]);
        Student::factory()->count(2)->create([
            'status' => StudentStatus::DataComplete,
            'group_id' => $group->id,
        ]);
        $stations = StationGroup::factory()->count(2)->create([
            'status' => StationGroupStatus::New,
        ]);
        $group->stations()->saveMany($stations);

        $firstStation = $group->stations()->orderBy('start_date', 'asc')->first();
        $this->assertEquals(StationGroupStatus::New, $firstStation->status);

        try {
            MarkGroupAsReady::run($group);
            $this->fail("Should not be able to mark group as ready if first station is not ready");
        } catch (InvalidStatusException $e) {
            $this->assertTrue(true);
        }

        $firstStation->status = StationGroupStatus::Scheduled;
        $firstStation->save();

        MarkGroupAsReady::run($group);
        $this->assertEquals(GroupStatus::Ready, $group->status);
    }
}
