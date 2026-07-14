<?php

namespace Dapodik\Laravel\API;

use Dapodik\Laravel\API\Concerns\Configuration;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Macroable;

class APIManager
{
    use Configuration;
    use Macroable {
        __call as macroCall;
    }

    protected $laravel;

    protected $connection = [];

    public function __construct(Application $laravel)
    {
        $this->laravel = $laravel;
    }

    public function connection($name = null)
    {
        $name = $name ?: $this->getDefaultConnection();

        return $this->configure($name);
    }

    protected function configure($name)
    {
        $config = $this->laravel['config']["dapodik-api.connections.$name"];

        if (! isset($config)) {
            throw new \InvalidArgumentException("Connection [$name] not configured.");
        }

        $config = $this->parseDriver(Arr::add($config, 'name', $name));

        $this->connection[$name] = new Connection($config);

        return $this->connection[$name];
    }

    public function getDefaultConnection()
    {
        return $this->laravel['config']['dapodik-api.default'];
    }

    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return $this->connection()->$method(...$parameters);
    }
}
