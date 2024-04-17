<?php

namespace App\Contracts;

interface TeamContract {
    public function getUserTeamsByUserId($userId, $paginateCount);
    public function getTeamsByFlow($selectedFlow, $paginateCount);
    public function getMembersWithVacancyByTeamId($teamId);
    public function getMembersByTeamId($teamId);
}
