<?php

namespace Dapodik\Laravel\API\Concerns;

use GuzzleHttp\TransferStats;

trait Authentication
{
    protected function authentication()
    {
        if (empty($this->config['username'])) {
            throw new \InvalidArgumentException('Username is required.');
        }
        if (empty($this->config['password'])) {
            throw new \InvalidArgumentException('Password is required.');
        }
        if (empty($this->config['kode_registrasi'])) {
            throw new \InvalidArgumentException('Kode Registrasi is required.');
        }

        $this->setFormParams('username', $this->config['username']);
        $this->setFormParams('password', $this->config['password']);
        $this->setFormParams('semester_id', $this->getSemester('key'));
        $this->setFormParams('rememberme', 'on');

        if (((count($this->getLinks()) !== 1) && (count($this->getRoles()) !== 1)) || strtolower($this->getRoles()[0]) !== 'operator sekolah') {
            throw new \InvalidArgumentException('Pastikan Akun anda adalah akun Operator Sekolah!');
        }

        $this->_request('GET', "/login?{$this->getLinks()[0]}");
        $this->forgeOptions('form_params');

        $this->checkKodeRegistrasi($this->config['kode_registrasi']);

        $this->setQuery('_dc', time().substr(str_shuffle('0123456789'), 0, 3));
        $this->setQuery('sekolah_id', $this->request('GET', 'sekolah')->toArray()['rows'][0]['sekolah_id']);
    }

    protected function getRolePage()
    {
        return $this->_request('POST', '/roleperan', [
            'on_stats' => function (TransferStats $stats) {
                if ($stats->hasResponse()) {
                    if ($stats->getResponse()->getStatusCode() === 302) {
                        $location = preg_match("/\/#(\S*)/", $stats->getResponse()->getHeader('Location')[0], $match) ? $match[1] : null;
                        if ($location == 'PasswordSalah') {
                            throw new \InvalidArgumentException('Password yang Anda masukkan salah!');
                        }
                        if ($location == 'PenggunaTidakTerdaftar') {
                            throw new \InvalidArgumentException('Email yang Anda masukkan tidak terdaftar pada aplikasi Dapodik! Mohon gunakan email lain.');
                        }
                        if ($location == 'SemesterTidakAktif') {
                            throw new \InvalidArgumentException('Semester telah dinonaktifkan.');
                        }
                        if ($location == 'RoleBelumDitentukan') {
                            throw new \InvalidArgumentException('Role pengguna belum ditentukan! Untuk akun GTK mohon menghubungi Operator Sekolah dan untuk akun Operator Sekolah mohon menghubungi Dinas Pendidikan. Terima Kasih.');
                        }
                        if ($location == 'NotPermission') {
                            throw new \InvalidArgumentException('Maaf, sekolah anda tidak diizinkan menggunakan Installer Aplikasi ini.');
                        }
                    }
                } else {
                    throw new \InvalidArgumentException($stats->getHandlerErrorData());
                }
            },
        ])->getBody()->getContents();
    }

    protected function getLinks()
    {
        return preg_match_all("/<a.+?href=['\"]\/login\?(\S*)['\"]>/", $this->getRolePage(), $matches) ? $matches[1] : [];
    }

    protected function getRoles()
    {
        return preg_match_all("/<span>Peran: (.*?)<\/span>/", $this->getRolePage(), $matches) ? $matches[1] : [];
    }

    protected function checkKodeRegistrasi($kode_registrasi)
    {
        $this->setFormParams('koreg', $kode_registrasi);
        $status = json_decode($this->_request('POST', '/cekkoreg')->getBody()->getContents());
        $this->forgeOptions('form_params');
        if (! $status->success) {
            $this->logout();

            throw new \InvalidArgumentException($status->message);
        }
    }

    protected function logout()
    {
        $this->_request('GET', '/destauth')->getBody()->getContents();

        return null;
    }
}
