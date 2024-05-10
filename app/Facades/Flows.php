<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Database\Eloquent\Collection getFlowsByGroup(string $groupId)
 */
class Flows extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'flows';
    }
}
