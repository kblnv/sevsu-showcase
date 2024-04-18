<?php

namespace App\Contracts;

interface TeamContract {
    public function getUserTeamsByUser($userId, $paginateCount);
    public function getTeamsByFlow($selectedFlow, $paginateCount);
    public function getMembersByTeam($teamId);
    public function getTeamsByTask($taskId);
}
