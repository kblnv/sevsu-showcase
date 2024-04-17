<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Tasks extends Facade {
    protected static function getFacadeAccessor()
    {
        return "tasks";
    }
}
