<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    use HasConnection;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected function casts(): array
    {
        return [
            'no_urut' => 'integer',
            'tipe' => 'integer',
        ];
    }
}
