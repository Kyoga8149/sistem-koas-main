<?php

namespace App\Nova\Actions\Groups;

use Exception;
use App\Models\Group;
use App\Models\Setting;
use App\Enums\StudyType;
use App\Models\StationGroup;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use App\Models\Enums\GroupStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ActionFields;
use App\Models\Enums\StationGroupStatus;
use Illuminate\Queue\InteractsWithQueue;
use App\Exceptions\InvalidStatusException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class CreateKoasSchedule extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = "Create Koas Schedule";

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
        if ($group->status !== GroupStatus::StudentAssigned) {
            throw new InvalidStatusException("Status is not student assigned");
        }

        if ($group->study_type !== StudyType::Clerkship) {
            throw new InvalidStatusException("Study type is not clerkship");
        }

        DB::beginTransaction();
        try {
            // create 11 stations for the Koas Group.
            $setting = Setting::where('key', Setting::KOAS_SCHEDULE_WEEK)->first();
            if (!$setting) {
                throw new Exception("Setting for Koas schedule week not found", 500);
            }
            $koasDurationWeeks = json_decode($setting->value, false);
            foreach ($koasDurationWeeks as $stationId => $durationWeeks) {

                $stationGroup = new StationGroup([
                    'group_id' => $group->id,
                    'station_id' => $stationId,
                    'status' => StationGroupStatus::New,
                ]);
                $stationGroup->save();
            }


            $group->status = GroupStatus::StationsScheduled;
            $group->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Error Processing Request", 500);
        }
    }
}
