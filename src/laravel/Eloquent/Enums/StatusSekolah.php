<?php

namespace Dapodik\Laravel\Eloquent\Enums;

enum StatusSekolah: int
{
    case Negeri = 1;
    case Swasta = 2;

    public static function label(self $value): string
    {
        return match ($value) {
            self::Negeri => 'Negeri',
            self::Swasta => 'Swasta',
        };
    }
}
