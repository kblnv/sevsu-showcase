<?php

namespace App\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TeamContract
{
    public function getUserTeamsByUser(string $userId, int $paginateCount): LengthAwarePaginator;

    public function getTeamsByFlow(string $selectedFlow, int $paginateCount): LengthAwarePaginator;

    public function getMembersByTeam(string $teamId): array;

    public function getTeamsByTask(string $taskId): array;

    public function createTeam(string $teamName, string $taskId, ?string $teamDescription = null, ?string $password = null): void;

    public function getUserTeamByFlow(string $flowId, string $userId): Collection;
}
