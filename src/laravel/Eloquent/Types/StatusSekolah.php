<?php

namespace Dapodik\Laravel\Eloquent\Types;

class StatusSekolah
{
    const Negeri = 1;

    const Swasta = 2;

    public static function label($value)
    {
        $labels = [
            self::Negeri => 'Negeri',
            self::Swasta => 'Swasta',
        ];

        return $labels[$value] ?? $value;
    }
}
