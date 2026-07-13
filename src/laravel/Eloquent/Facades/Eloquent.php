<?php

namespace Dapodik\Laravel\Eloquent\Facades;

use Dapodik\Laravel\Eloquent\EloquentManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getConfig()
 * @method static string getConnectionName()
 * @method static array getConnections()
 * @method static string getDriverName()
 * @method static bool useSplitConnection()
 * @method static array supportedDrivers()
 *
 * @see EloquentManager
 */
class Eloquent extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'dapodik.eloquent.laravel';
    }
}
