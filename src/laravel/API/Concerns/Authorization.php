<?php

namespace Dapodik\Laravel\API\Concerns;

use Dapodik\Laravel\API\Contracts\ResponseContract;

trait Authorization
{
    protected function authorization()
    {
        if (empty($this->config['npsn'])) {
            throw new \InvalidArgumentException('NPSN is required.');
        }
        if (empty($this->config['token'])) {
            throw new \InvalidArgumentException('Token is required.');
        }

        $this->setHeaders('Authorization', 'Bearer '.$this->config['token']);
        $this->setQuery('npsn', $this->config['npsn']);
    }

    public function getSekolah(): ResponseContract
    {
        return $this->query('getSekolah');
    }

    public function getPengguna(): ResponseContract
    {
        return $this->query('getPengguna');
    }

    public function getRombonganBelajar(): ResponseContract
    {
        return $this->query('getRombonganBelajar');
    }

    public function getRombel(): ResponseContract
    {
        return $this->query('getRombonganBelajar');
    }

    public function getPesertaDidik(): ResponseContract
    {
        return $this->query('getPesertaDidik');
    }

    public function getPd(): ResponseContract
    {
        return $this->query('getPesertaDidik');
    }

    public function getGtk(): ResponseContract
    {
        return $this->query('getGtk');
    }
}
