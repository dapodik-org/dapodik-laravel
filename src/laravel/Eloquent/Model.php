<?php

namespace Dapodik\Laravel\Eloquent;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel
{
    use HasConnection;

    protected function casts()
    {
        return [
            'last_sync' => 'datetime',
        ];
    }
}
