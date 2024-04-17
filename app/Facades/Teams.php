<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Teams extends Facade {
    protected static function getFacadeAccessor()
    {
        return "teams";
    }
}
