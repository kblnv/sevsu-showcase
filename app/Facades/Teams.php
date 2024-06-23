<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Contracts\Pagination\LengthAwarePaginator getTeamsByFlow(string $flowName, int $paginateCount)
 * @method static array getTeamsByTask(string $taskId)
 * @method static App\Models\Team|null getUserTeamByFlow(string $flowId, string $userId)
 * @method static void createTeam(string $teamName, string $taskId, ?string $teamDescription = null, ?string $password = null)
 * @method static bool isFlowHasTeam(string $flowId, string $teamName)
 * @method static bool hasUserTeam(string $flowId, string $userId)
 * @method static bool canCreateTeam(string $taskId, string $userId)
 * @method static App\Models\Team|null getTeam(string $teamId)
 * @method static void deleteMember(string $userId, string $teamId)
 * @method static array getTeamVacancies(string $teamId)
 * @method static void updateTeam(string $teamId, string $teamName, string $teamDescription)
 * @method static void setVacancy(string $vacancyId, string $userId)
 * @method static void unsetVacancy(string $teamId, string $userId)
 * @method static void setPassword(string $teamId, string $password)
 * @method static bool isModerator(string $teamId, string $userId)
 */
class Teams extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'teams';
    }
}
