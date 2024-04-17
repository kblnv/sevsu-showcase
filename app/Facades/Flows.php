<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Flows extends Facade {
    protected static function getFacadeAccessor()
    {
        return "flows";
    }
}
