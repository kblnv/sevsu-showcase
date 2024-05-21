<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Database\Eloquent\Collection getFlowsByGroup(string $groupId)
 * @method static App\Models\Flow getFlowByTask(string $taskId)
 */
class Flows extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'flows';
    }
}
