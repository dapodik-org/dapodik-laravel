<?php

namespace Dapodik\Laravel\API\Concerns;

trait Configuration
{
    protected function parseDriver(array $config): array
    {
        if (! in_array($config['driver'], $this->supportDrivers())) {
            throw new \InvalidArgumentException("Driver [{$config['driver']}] not supported.");
        }

        return $config;
    }

    protected function supportDrivers(): array
    {
        return ['rest', 'webservice'];
    }

    protected function parseHost(array $config): array
    {
        if (! isset($config['host'])) {
            throw new \InvalidArgumentException('Host is required.');
        }

        return $config;
    }

    protected function parseUsername(array $config): array
    {
        if (! isset($config['username'])) {
            throw new \InvalidArgumentException('Username is required.');
        }

        return $config;
    }

    protected function parsePassword(array $config): array
    {
        if (! isset($config['password'])) {
            throw new \InvalidArgumentException('Password is required.');
        }

        return $config;
    }

    protected function parseKodeRegistrasi(array $config): array
    {
        if (! isset($config['kode_registrasi'])) {
            throw new \InvalidArgumentException('Kode Registrasi is required.');
        }

        return $config;
    }

    protected function parseNpsn(array $config): array
    {
        if (! isset($config['npsn'])) {
            throw new \InvalidArgumentException('NPSN is required.');
        }

        return $config;
    }

    protected function parseToken(array $config): array
    {
        if (! isset($config['token'])) {
            throw new \InvalidArgumentException('Token is required.');
        }

        return $config;
    }
}
