<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface FlowContract {
    public function getFlowsByGroup(string $groupId): Collection;
}
