<?php

namespace Dapodik\Laravel\API\Facades;

use Dapodik\Laravel\API\APIManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Dapodik\Laravel\API\Connection connection(string $name = null)
 * @method static \Dapodik\Laravel\API\Contracts\ResponseContract request(string $method, $uri, array $options = [])
 * @method static \Dapodik\Laravel\API\Contracts\ResponseContract query($uri, array $query = [], string $method = 'GET')
 * @method static \Dapodik\Laravel\API\Contracts\ResponseContract getSekolah()
 * @method static \Dapodik\Laravel\API\Contracts\ResponseContract getPengguna()
 * @method static \Dapodik\Laravel\API\Contracts\ResponseContract getRombonganBelajar()
 * @method static \Dapodik\Laravel\API\Contracts\ResponseContract getRombel()
 * @method static \Dapodik\Laravel\API\Contracts\ResponseContract getPesertaDidik()
 * @method static \Dapodik\Laravel\API\Contracts\ResponseContract getPd()
 * @method static \Dapodik\Laravel\API\Contracts\ResponseContract getGtk()
 * @method static bool isConnect()
 * @method static string getDefaultConnection()
 *
 * @see APIManager
 */
class API extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'dapodik.api.laravel';
    }
}
