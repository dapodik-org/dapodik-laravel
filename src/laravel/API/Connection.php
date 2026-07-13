<?php

namespace Dapodik\Laravel\API;

use Dapodik\Laravel\API\Concerns\Authentication;
use Dapodik\Laravel\API\Concerns\Authorization;
use Dapodik\Laravel\API\Concerns\Configuration;
use Dapodik\Laravel\API\Concerns\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Arr;

class Connection
{
    use Authentication;
    use Authorization;
    use Configuration;
    use Request;

    protected $client;

    protected $cookie;

    protected $config;

    public function __construct(array $config)
    {
        $this->config = $this->parseConfig($config);
        $this->cookie = new CookieJar();
        $this->client = $this->setClient();
        $this->auth();
    }

    protected function auth()
    {
        switch ($this->config['driver']) {
            case 'rest':
                $this->authentication();
                break;
            case 'webservice':
                $this->authorization();
                break;
            default:
                throw new \InvalidArgumentException("Driver {$this->config['driver']} not supported.");
        }
    }

    protected function parseConfig(array $config)
    {
        $config = $this->parseDriver($this->parseHost($config));

        switch ($config['driver']) {
            case 'rest':
                return Arr::add(
                    $this->parseUsername($this->parsePassword($this->parseKodeRegistrasi($config))),
                    'path',
                    '/rest'
                );
            case 'webservice':
                return Arr::add(
                    $this->parseNpsn($this->parseToken($config)),
                    'path',
                    '/WebService'
                );
            default:
                throw new \InvalidArgumentException("Driver {$config['driver']} not supported.");
        }
    }

    protected function setClient()
    {
        if (!isset($this->config['host'])) {
            throw new \InvalidArgumentException("Parameter 'host' not set.");
        }

        return new Client([
            'base_uri' => $this->config['host'],
            'cookies' => $this->cookie,
            'verify' => false,
            'headers' => [
                'User-Agent' => 'DapodikOrg/DapodikAPI',
            ],
        ]);
    }
}
