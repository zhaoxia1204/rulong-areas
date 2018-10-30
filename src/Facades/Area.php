<?php

namespace RuLong\Area\Facades;

use Illuminate\Support\Facades\Facade;

class Area extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RuLong\Area\Area::class;
    }
}
