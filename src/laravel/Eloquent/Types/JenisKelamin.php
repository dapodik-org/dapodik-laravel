<?php

namespace Dapodik\Laravel\Eloquent\Types;

class JenisKelamin
{
    const LakiLaki = 'L';

    const Perempuan = 'P';

    public static function label($value)
    {
        $labels = [
            self::LakiLaki => 'Laki - laki',
            self::Perempuan => 'Perempuan',
        ];

        return $labels[$value] ?? $value;
    }
}
