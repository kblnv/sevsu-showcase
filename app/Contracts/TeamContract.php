<?php

namespace App\Contracts;

use App\Models\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TeamContract
{
    public function getUserTeamsByUser(string $userId, int $paginateCount): LengthAwarePaginator;

    public function getTeamsByFlow(string $flowName, int $paginateCount): LengthAwarePaginator;

    public function getMembersByTeam(string $teamId): array;

    public function getTeamsByTask(string $taskId): array;

    public function getUserTeamByFlow(string $flowId, string $userId): ?Team;

    public function createTeam(string $teamName, string $taskId, ?string $teamDescription = null, ?string $password = null): void;

    public function isFlowHasTeam(string $flowId, string $teamName): bool;

    public function isUserHasTeamByFlow(string $flowId, string $userId): bool;

    public function canCreateTeam(string $taskId, string $userId): bool;
}
