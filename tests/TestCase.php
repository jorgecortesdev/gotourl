<?php

namespace Xorth\GoToUrl\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Xorth\GoToUrl\GoToUrlServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            GoToUrlServiceProvider::class,
        ];
    }
}