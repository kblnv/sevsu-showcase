<?php

namespace App\Contracts;

use App\Models\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TeamContract
{
    public function getUserTeams(string $userId, int $paginateCount): LengthAwarePaginator;

    public function getTeamsByFlow(string $flowName, int $paginateCount): LengthAwarePaginator;

    public function getMembersByTeam(string $teamId): array;

    public function getTeamsByTask(string $taskId): array;

    public function getUserTeamByFlow(string $flowId, string $userId): ?Team;

    public function createTeam(string $teamName, string $taskId, ?string $teamDescription = null, ?string $password = null): void;

    public function isFlowHasTeam(string $flowId, string $teamName): bool;

    public function isUserHasTeam(string $flowId, string $userId): bool;

    public function canCreateTeam(string $taskId, string $userId): bool;

    public function getTeam(string $teamId): ?Team;

    public function addMember(string $userId, string $teamId): void;

    public function deleteMember(string $userId, string $teamId): void;

    public function getTeamVacancies(string $teamId): array;

    public function updateTeam(string $flowId, string $teamId, string $teamName, string $teamDescription): void;

    public function deleteTeam(string $teamId): void;

    public function createVacancy(string $vacancyName, string $teamId, ?string $userId = null): void;

    public function deleteVacancy(string $vacancyId): void;

    public function setVacancy(string $vacancyId, string $userId): void;

    public function setPassword(string $teamId, string $password): void;

    public function isModerator(string $teamId, string $userId): ?bool;
}
