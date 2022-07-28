<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use App\Nova\Dashboards\Main;
use App\Nova\Group;
use App\Nova\Lenses\KoasGroup;
use App\Nova\Lenses\KoasStudent;
use App\Nova\Station;
use App\Nova\Student;
use App\Nova\Teacher;
use App\Nova\User;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSeparator;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),

                MenuSection::make('Koas', [
                    MenuItem::link('Create Group', 'resources/groups/new?study_type=koas'),
                    MenuItem::lens(Group::class, KoasGroup::class),
                    MenuItem::lens(Student::class, KoasStudent::class),
                ]),

                MenuSeparator::make(),

                MenuSection::make('Settings', [
                    MenuItem::resource(Teacher::class),
                ]),

            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
