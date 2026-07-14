<?php

namespace Dapodik\Laravel\Eloquent\Types;

class StatusPerkawinan
{
    const Kawin = 1;

    const BelumKawin = 2;

    public static function label($value)
    {
        $labels = [
            self::Kawin => 'Kawin',
            self::BelumKawin => 'Belum Kawin',
        ];

        return $labels[$value] ?? $value;
    }
}
