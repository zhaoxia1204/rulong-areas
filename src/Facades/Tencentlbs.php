<?php

namespace RuLong\Area\Facades;

use Illuminate\Support\Facades\Facade;

class Tencentlbs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RuLong\Area\TencentIbs::class;
    }
}
