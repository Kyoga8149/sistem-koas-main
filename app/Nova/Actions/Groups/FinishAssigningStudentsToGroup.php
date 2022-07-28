<?php

namespace App\Nova\Actions\Groups;

use App\Models\Group;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use App\Models\Enums\GroupStatus;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use App\Exceptions\InvalidStatusException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class FinishAssigningStudentsToGroup extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        /** @var Group $model */
        foreach ($models as $model) {
            $this->execute($model);
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

    public function execute(Group $group): void
    {
        if ($group->status !== GroupStatus::New) {
            throw new InvalidStatusException("Status is not new");
        }

        $group->status = GroupStatus::StudentAssigned;
        $group->save();
    }
}
