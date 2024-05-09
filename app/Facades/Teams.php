<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Contracts\Pagination\LengthAwarePaginator getUserTeamsByUser(string $userId, int $paginateCount)
 * @method static \Illuminate\Contracts\Pagination\LengthAwarePaginator getTeamsByFlow(string $selectedFlow, int $paginateCount)
 * @method static array getMembersByTeam(string $teamId)
 * @method static array getTeamsByTask(string $taskId)
 */
class Teams extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'teams';
    }
}
