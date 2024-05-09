<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getTags(string $taskId)
 */
class Tags extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tags';
    }
}
