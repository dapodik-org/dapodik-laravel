<?php

namespace Dapodik\Laravel\Eloquent\Enums;

enum JenisKelamin: string
{
    case LakiLaki = 'L';
    case Perempuan = 'P';

    public static function label(self $value): string
    {
        return match ($value) {
            self::LakiLaki => 'Laki - laki',
            self::Perempuan => 'Perempuan',
        };
    }
}
