<?php

namespace App\Nova\Actions\Students;

use Exception;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use App\Actions\Concerns\AsAction;
use Illuminate\Support\Collection;
use App\Models\Enums\StudentStatus;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use App\Exceptions\InvalidStatusException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class MarkStudentDataAsComplete extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = "Data is Complete";

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        /** @var Student model */
        foreach ($models as $model) {
            $this->executeAction($model);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }

    public function handleResult(ActionFields $fields, $results)
    {
        $models = collect($results);
        return Action::message(sprintf('%s students have completed their data.', $models->count()));
    }

    public function executeAction(Student $student)
    {
        if ($student->status !== StudentStatus::New) {
            throw new InvalidStatusException("Status is not new");
        }

        if ($student->full_name === '' || $student->student_number === '') {
            throw new Exception("Student data is not complete", 400);
        }

        $student->status = StudentStatus::DataComplete;
        $student->save();
    }
}
