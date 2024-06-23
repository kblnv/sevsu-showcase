<?php

namespace App\Services;

use App\Contracts\TeamContract;
use App\Facades\Flows;
use App\Facades\Tasks;
use App\Models\Team;
use App\Models\UserTeam;
use App\Models\Vacancy;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeamService implements TeamContract
{
    public function getUserTeams(string $userId, int $paginateCount = 10): LengthAwarePaginator
    {
        return Team::select(
            'tasks.flow_id',
            'flows.flow_name',
            'flows.max_team_size',
            'teams.id',
            'teams.team_name',
            'teams.team_description',
            'teams.task_id',
            'tasks.task_name',
            'tasks.task_description',
        )
            ->join('users_teams', 'teams.id', 'users_teams.team_id')
            ->join('users', 'users_teams.user_id', 'users.id')
            ->where('users.id', $userId)
            ->join('tasks', 'teams.task_id', 'tasks.id')
            ->join('flows', 'tasks.flow_id', 'flows.id')
            ->paginate($paginateCount);
    }

    public function getTeamsByFlow(string $flowName, int $paginateCount = 10): LengthAwarePaginator
    {
        return Team::select(
            'teams.id',
            'teams.team_name',
            'teams.team_description',
            'teams.task_id',
            'tasks.task_name',
            'tasks.task_description',
        )
            ->join('tasks', 'teams.task_id', 'tasks.id')
            ->join('flows', 'tasks.flow_id', 'flows.id')
            ->where('flows.flow_name', $flowName)
            ->paginate($paginateCount);
    }

    public function getMembersByTeam(string $teamId): array
    {
        return UserTeam::select(
            'users.id',
            'users.first_name',
            'users.second_name',
            'users.last_name',
            'users_teams.is_moderator',
            'vacancies.vacancy_name',
        )
            ->join('users', 'users_teams.user_id', 'users.id')
            ->join('teams', 'teams.id', 'users_teams.team_id')
            ->where('teams.id', $teamId)
            ->leftJoin('vacancies', function ($join) use ($teamId) {
                $join->on('users.id', 'vacancies.user_id')
                    ->where('vacancies.team_id', $teamId);
            })
            ->get()
            ->toArray();
    }

    public function getTeam(string $teamId): ?Team
    {
        return Team::select(
            'tasks.flow_id',
            'flows.flow_name',
            'flows.max_team_size',
            'teams.id',
            'teams.team_name',
            'teams.team_description',
            'teams.task_id',
            'tasks.task_name',
            'tasks.task_description',
        )
            ->join('tasks', 'tasks.id', 'teams.task_id')
            ->join('flows', 'tasks.flow_id', 'flows.id')
            ->where('teams.id', $teamId)
            ->first();
    }

    public function createTeam(string $teamName, string $taskId, ?string $teamDescription = null, ?string $password = null): void
    {
        $team = Team::create([
            'team_name' => $teamName,
            'team_description' => $teamDescription,
            'password' => Hash::make($password),
            'task_id' => $taskId,
        ]);

        UserTeam::create([
            'team_id' => $team->id,
            'user_id' => Auth::id(),
            'is_moderator' => 1,
        ]);
    }

    public function updateTeam(string $flowId, string $teamId, string $teamName, string $teamDescription): void
    {
        $uniqueTeam = $this->isFlowHasTeam($flowId, $teamName);

        if (!$uniqueTeam) {
            Team::where('id', $teamId)
                ->update([
                    'team_name' => $teamName,
                    'team_description' => $teamDescription,
                ]);
        }
    }

    public function deleteTeam(string $teamId): void
    {
        $team = Team::find($teamId);

        $team?->delete();
    }

    public function addMember(string $userId, string $teamId): void
    {
        UserTeam::createOrFirst([
            'user_id' => $userId,
            'team_id' => $teamId,
        ]);
    }

    public function deleteMember(string $userId, string $teamId): void
    {
        $member = UserTeam::where([
            ['user_id', $userId],
            ['team_id', $teamId],
        ])
            ->first();

        $member?->delete();
    }

    public function createVacancy(string $vacancyName, string $teamId, ?string $userId = null): void
    {
        Vacancy::createOrFirst([
            'vacancy_name' => $vacancyName,
            'team_id' => $teamId,
            'user_id' => $userId,
        ]);
    }

    public function deleteVacancy(string $vacancyId): void
    {
        $vacancy = Vacancy::find($vacancyId);

        $vacancy?->delete();
    }

    public function setVacancy(string $vacancyId, string $userId): void
    {
        Vacancy::where('id', $vacancyId)
            ->update(['user_id' => $userId]);
    }

    public function unsetVacancy(string $teamId, string $userId): void
    {
        Vacancy::where([
            ['team_id', $teamId],
            ['user_id', $userId],
        ])
            ->update(['user_id' => null]);
    }


    public function setPassword(string $teamId, string $password): void
    {
        Team::where('id', $teamId)
            ->update(['password' => Hash::make($password)]);
    }

    public function setModerator(string $teamId, string $userId, bool $isModerator = true): void
    {
        UserTeam::where([
            ['user_id', $userId],
            ['team_id', $teamId],
        ])
            ->update(['is_moderator' => $isModerator]);
    }

    public function isModerator(string $teamId, string $userId): ?bool
    {
        return UserTeam::where([
            ['team_id', $teamId],
            ['user_id', $userId],
        ])
            ->value('is_moderator');
    }

    public function getTeamVacancies(string $teamId): array
    {
        return Vacancy::select(
            'vacancies.id',
            'vacancies.user_id',
            'vacancies.vacancy_name'
        )
            ->where('vacancies.team_id', $teamId)
            ->get()
            ->toArray();
    }

    public function getTeamsByTask(string $taskId): array
    {
        return Team::select(
            'teams.id',
            'teams.team_name',
            'teams.team_description',
            'teams.task_id',
            'tasks.task_name',
            'tasks.task_description',
        )
            ->join('tasks', 'teams.task_id', 'tasks.id')
            ->where('teams.task_id', $taskId)
            ->get()
            ->toArray();
    }

    public function getUserTeamByFlow(string $flowId, string $userId): ?Team
    {
        return Team::select(
            'teams.id',
            'teams.team_name',
            'teams.team_description',
            'teams.task_id',
        )
            ->join('tasks', 'teams.task_id', 'tasks.id')
            ->where('tasks.flow_id', $flowId)
            ->join('users_teams', 'users_teams.team_id', 'teams.id')
            ->where('users_teams.user_id', $userId)
            ->first();
    }

    public function isFlowHasTeam(string $flowId, string $teamName): bool
    {
        return Team::where('team_name', $teamName)
            ->join('tasks', 'tasks.id', 'teams.task_id')
            ->where('tasks.flow_id', $flowId)
            ->exists();
    }

    public function isUserHasTeam(string $flowId, string $userId): bool
    {
        return Team::join('tasks', 'teams.task_id', 'tasks.id')
            ->where('tasks.flow_id', $flowId)
            ->join('users_teams', 'users_teams.team_id', 'teams.id')
            ->where('users_teams.user_id', $userId)
            ->exists();
    }

    public function canCreateTeam(string $taskId, string $userId): bool
    {
        $flow = Flows::getFlowByTask($taskId);

        $userHasTeam = $this->isUserHasTeam($flow->id, $userId);

        $remainingPlaces = Tasks::getRemainingTeamsCount($taskId);

        return (!$userHasTeam) && ($remainingPlaces > 0);
    }
}
