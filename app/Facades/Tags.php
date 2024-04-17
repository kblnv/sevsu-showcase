<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Tags extends Facade {
    protected static function getFacadeAccessor()
    {
        return "tags";
    }
}
