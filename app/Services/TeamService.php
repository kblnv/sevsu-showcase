<?php

namespace App\Services;
use App\Contracts\TeamContract;
use App\Models\UserTeam;
use App\Models\Team;

class TeamService implements TeamContract {
    public function getUserTeamsByUserId($userId, $paginateCount = 10)
    {
        return Team::select(
            "tasks.flow_id",
            "flows.flow_name",
            "flows.max_team_size",
            "teams.id",
            "teams.team_name",
            "teams.team_description",
            "teams.task_id",
            "tasks.task_name",
            "tasks.task_description",
        )
            ->join("users_teams", "teams.id", "=", "users_teams.team_id")
            ->join("users", "users_teams.user_id", "=", "users.id")
            ->where("users.id", "=", $userId)
            ->join("tasks", "teams.task_id", "=", "tasks.id")
            ->join("flows", "tasks.flow_id", "=", "flows.id")
            ->paginate($paginateCount);
    }

    public function getTeamsByFlow($selectedFlow, $paginateCount = 10)
    {
        return Team::select(
            "teams.id",
            "teams.team_name",
            "teams.team_description",
            "teams.task_id",
            "tasks.task_name",
            "tasks.task_description",
        )
            ->join("tasks", "teams.task_id", "=", "tasks.id")
            ->join("flows", "tasks.flow_id", "=", "flows.id")
            ->where("flows.flow_name", "=", $selectedFlow)
            ->paginate($paginateCount);
    }

    public function getMembersWithVacancyByTeamId($teamId)
    {
        return UserTeam::select(
            "users.first_name",
            "users.second_name",
            "users.last_name",
            "users_teams.is_moderator",
            "vacancies.vacancy_name",
        )
            ->join("users", "users_teams.user_id", "=", "users.id")
            ->join("teams", "teams.id", "=", "users_teams.team_id")
            ->where("teams.id", "=", $teamId)
            ->join("vacancies", "users.id", "=", "vacancies.user_id")
            ->where("vacancies.team_id", "=", $teamId)
            ->get()
            ->toArray();
    }

    public function getMembersByTeamId($teamId)
    {
        return UserTeam::select(
            "users.first_name",
            "users.second_name",
            "users.last_name",
            "users_teams.is_moderator",
            "vacancies.vacancy_name",
        )
            ->join("users", "users_teams.user_id", "=", "users.id")
            ->join("teams", "teams.id", "=", "users_teams.team_id")
            ->where("teams.id", "=", $teamId)
            ->leftJoin("vacancies", function ($join) use ($teamId) {
                $join->on("users.id", "=", "vacancies.user_id")
                    ->where("vacancies.team_id", "=", $teamId);
            })
            ->get()
            ->toArray();
    }
}
