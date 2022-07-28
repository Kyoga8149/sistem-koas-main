<?php

namespace App\Nova;

use App\Enums\StudyType;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use App\Nova\Lenses\KoasGroup;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use App\Nova\Fields\CustomField;
use Laravel\Nova\Fields\HasMany;
use App\Models\Enums\GroupStatus;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use App\Nova\Fields\SelectStudyType;
use App\Models\School as ModelSchool;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\Groups\MarkGroupAsReady;
use App\Nova\Actions\Groups\CreateKoasSchedule;
use App\Nova\Actions\Groups\FinishAssigningStudentsToGroup;
use Illuminate\Support\Facades\Log;

class Group extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Group::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->required(),
            Textarea::make('Description')
                ->nullable()
                ->hideFromIndex(),

            CustomField::selectStudyType()
                ->default(function (Request $request) {
                    return $request->input('study_type');
                })
                ->required(),
            BelongsTo::make('Station'),
         
            Date::make('Start Date')
                ->default(now()->addDay())
                ->required(),
            Date::make('End Date')
                ->default(now()->addYear(2))
                ->required(),

            Hidden::make('Status')
                ->default(GroupStatus::New)
                ->showOnCreating(),
            Text::make('Status')
                ->readonly()
                ->hideWhenCreating(),

            // Select::make('School', 'school_id')
            //     ->options(function () {
            //         return ModelSchool::all()
            //             ->pluck('name', 'id');
            //     })
            //     ->showOnCreating()
            //     ->hideFromDetail()
            //     ->hideFromIndex()
            //     ->required(),

            BelongsTo::make('School'),

            MorphMany::make('Attachments'),

            HasMany::make('Students'),

            HasMany::make('Stations', 'stationGroups', StationGroup::class),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [
            KoasGroup::make(),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            FinishAssigningStudentsToGroup::make()
                ->canSee(function ($request) {
                    if ($this->resource->status !== GroupStatus::New) return false;
                    return true;
                }),

            CreateKoasSchedule::make()
                ->canSee(function ($request) {
                    if ($this->resource->status !== GroupStatus::StudentAssigned) return false;
                    if ($this->resource->study_type !== StudyType::Clerkship) return false;
                    return true;
                }),

            MarkGroupAsReady::make()
                ->canSee(function ($request) {
                    // Log::error("hello");
                    // if ($this->resource->status === GroupStatus::StationsScheduled) return true;
                    // return false;
                    return true;
                }),
        ];
    }
}
