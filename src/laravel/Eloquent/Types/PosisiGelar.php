<?php

namespace Dapodik\Laravel\Eloquent\Types;

class PosisiGelar
{
    const Depan = 1;
    const Belakang = 2;

    public static function label($value)
    {
        $labels = [
            self::Depan => 'Depan',
            self::Belakang => 'Belakang',
        ];

        return $labels[$value] ?? $value;
    }
}
