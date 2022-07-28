<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models {
    /**
     * App\Models\Admin
     *
     * @property int $id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property int $user_id
     * @property-read \App\Models\User $user
     * @method static \Database\Factories\AdminFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
     * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUserId($value)
     */
    class Admin extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Grade
     *
     * @property int $id
     * @property int $station_group_id
     * @property int $student_id
     * @property string|null $competency_target
     * @property string|null $supervision_level
     * @property \Illuminate\Support\Carbon|null $grade_deadline
     * @property string|null $grade_total
     * @property string|null $grade_note
     * @property \App\Models\GradeStatus $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\StationGroup|null $assignedStation
     * @property-read \App\Models\Student $student
     * @method static \Illuminate\Database\Eloquent\Builder|Grade newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Grade newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Grade query()
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereCompetencyTarget($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereGradeDeadline($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereGradeNote($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereGradeTotal($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereStationGroupId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereStudentId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereSupervisionLevel($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Grade whereUpdatedAt($value)
     */
    class Grade extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Group
     *
     * @property int $id
     * @property string $name
     * @property string|null $description
     * @property \App\Enums\StudyType $study_type
     * @property int $sender_id
     * @property \Illuminate\Support\Carbon $start_date
     * @property \Illuminate\Support\Carbon $end_date
     * @property \App\Models\Enums\GroupStatus $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StationGroup[] $assignedStations
     * @property-read int|null $assigned_stations_count
     * @property-read \App\Models\Institution $school
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
     * @property-read int|null $students_count
     * @method static \Database\Factories\GroupFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Group newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Group newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Group query()
     * @method static \Illuminate\Database\Eloquent\Builder|Group whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Group whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Group whereEndDate($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Group whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Group whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Group whereSenderId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Group whereStartDate($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Group whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Group whereStudyType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Group whereUpdatedAt($value)
     */
    class Group extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\GroupStudent
     *
     * @property-read \App\Models\Group|null $group
     * @property-read \App\Models\Student $student
     * @method static \Database\Factories\GroupStudentFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|GroupStudent newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|GroupStudent newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|GroupStudent query()
     */
    class GroupStudent extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Institution
     *
     * @property int $id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property string $name
     * @property \App\Enums\InstitutionType $type
     * @property \App\Enums\InstitutionSubType|null $subtype
     * @method static \Database\Factories\InstitutionFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Institution newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Institution newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Institution query()
     * @method static \Illuminate\Database\Eloquent\Builder|Institution whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Institution whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Institution whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Institution whereSubtype($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Institution whereType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Institution whereUpdatedAt($value)
     */
    class Institution extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Station
     *
     * @property int $id
     * @property string $key
     * @property string $name
     * @property int $hospital_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Institution|null $hospital
     * @method static \Database\Factories\StationFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Station newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Station newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Station query()
     * @method static \Illuminate\Database\Eloquent\Builder|Station whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Station whereHospitalId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Station whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Station whereKey($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Station whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Station whereUpdatedAt($value)
     */
    class Station extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\StationGroup
     *
     * @property int $id
     * @property int $group_id
     * @property int $station_id
     * @property int $teacher_id
     * @property \Illuminate\Support\Carbon $start_date
     * @property \Illuminate\Support\Carbon $end_date
     * @property \use App\Models\Enums\StationGroupStatus; $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Grade[] $grades
     * @property-read int|null $grades_count
     * @property-read \App\Models\Group $group
     * @property-read \App\Models\Station $station
     * @property-read \App\Models\Teacher $teacher
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup query()
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup whereEndDate($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup whereGroupId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup whereStartDate($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup whereStationId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup whereTeacherId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StationGroup whereUpdatedAt($value)
     */
    class StationGroup extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Student
     *
     * @property int $id
     * @property string $full_name
     * @property int $institution_id
     * @property string $student_number
     * @property string|null $email
     * @property string|null $phone
     * @property \App\Enums\StudyType $study_type
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
     * @property-read int|null $groups_count
     * @property-read \App\Models\Institution $school
     * @method static \Database\Factories\StudentFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Student query()
     * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Student whereFullName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Student whereInstitutionId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Student wherePhone($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Student whereStudentNumber($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Student whereStudyType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
     */
    class Student extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Subject
     *
     * @property int $id
     * @property string $name
     * @property string|null $description
     * @property \App\Enums\StudyType $study_type
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Database\Factories\SubjectFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
     * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Subject whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Subject whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Subject whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Subject whereStudyType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Subject whereUpdatedAt($value)
     */
    class Subject extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Teacher
     *
     * @property int $id
     * @property string $full_name
     * @property int $station_id
     * @property string|null $email
     * @property string|null $phone
     * @property \App\Enums\TeachingType $teaching_type
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Station $station
     * @method static \Database\Factories\TeacherFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher query()
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereFullName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher wherePhone($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereStationId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereTeachingType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereUpdatedAt($value)
     */
    class Teacher extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\User
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property \Illuminate\Support\Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Admin|null $admin
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
     * @property-read int|null $tokens_count
     * @method static \Database\Factories\UserFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     */
    class User extends \Eloquent
    {
    }
}
