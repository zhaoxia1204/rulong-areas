<?php

namespace RuLong\Area\Facades;

use Illuminate\Support\Facades\Facade;

class Address extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RuLong\Area\Address::class;
    }
}
