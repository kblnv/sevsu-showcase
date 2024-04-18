<?php

namespace App\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TeamContract {
    public function getUserTeamsByUser(string $userId, int $paginateCount): LengthAwarePaginator;
    public function getTeamsByFlow(string $selectedFlow, int $paginateCount): LengthAwarePaginator;
    public function getMembersByTeam(string $teamId): array;
    public function getTeamsByTask(string $taskId): array;
}
