<?php

namespace Mcire\PayTech\Facades;

use Illuminate\Support\Facades\Facade;

class PayTech extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'paytech';
    }
}
