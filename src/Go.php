<?php

namespace Xorth\GoToUrl;

use Illuminate\Support\Facades\Facade;

class Go extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GoToUrl::class;
    }
}
