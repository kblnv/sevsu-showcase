<?php

namespace App\Providers;

use App\Contracts\FlowContract;
use App\Contracts\TagContract;
use App\Contracts\TaskContract;
use App\Contracts\TeamContract;
use App\Facades\Flows;
use App\Models\Team;
use App\Services\FlowService;
use App\Services\TagService;
use App\Services\TaskService;
use App\Services\TeamService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind('flows', FlowContract::class);
        $this->app->bind('tasks', TaskContract::class);
        $this->app->bind('teams', TeamContract::class);
        $this->app->bind('tags', TagContract::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::anonymousComponentPath(resource_path('views/blade'));
        Blade::setPath(resource_path('views/blade'));

        Validator::extend('unique_team_flow', function ($attribute, $value, $parameters, $validator) {
            $taskId = $parameters[0] ?? null;

            if ($taskId) {
                $flow = Flows::getFlowByTask($taskId);

                return ! Team::where('team_name', $value)
                    ->join('tasks', 'tasks.id', '=', 'teams.task_id')
                    ->where('tasks.flow_id', $flow->id)
                    ->exists();
            }

            return false;
        });
    }
}
