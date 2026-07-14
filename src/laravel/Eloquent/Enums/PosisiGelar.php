<?php

namespace Dapodik\Laravel\Eloquent\Enums;

enum PosisiGelar: int
{
    case Depan = 1;
    case Belakang = 2;

    public static function label(self $value): string
    {
        return match ($value) {
            self::Depan => 'Depan',
            self::Belakang => 'Belakang',
        };
    }
}
