<?php

namespace App\Providers;

use App\Contracts\FlowContract;
use App\Contracts\TagContract;
use App\Contracts\TaskContract;
use App\Contracts\TeamContract;
use Illuminate\Support\ServiceProvider;
use App\Services\TeamService;
use App\Services\TagService;
use App\Services\FlowService;
use App\Services\TaskService;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TeamContract::class, TeamService::class);
        $this->app->bind(TagContract::class, TagService::class);
        $this->app->bind(FlowContract::class, FlowService::class);
        $this->app->bind(TaskContract::class, TaskService::class);
        $this->app->bind("flows", FlowContract::class);
        $this->app->bind("tasks", TaskContract::class);
        $this->app->bind("teams", TeamContract::class);
        $this->app->bind("tags", TagContract::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
