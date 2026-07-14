<?php

namespace Dapodik\Laravel\Eloquent\Enums;

enum StatusPerkawinan: int
{
    case Kawin = 1;
    case BelumKawin = 2;

    public static function label(self $value): string
    {
        return match ($value) {
            self::Kawin => 'Kawin',
            self::BelumKawin => 'Belum Kawin',
        };
    }
}
