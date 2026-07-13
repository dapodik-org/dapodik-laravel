<?php

namespace Dapodik\Laravel\Eloquent\Models\Eloquent;

use Dapodik\Laravel\Eloquent\Model;

class SyncStatus extends Model
{
    public $incrementing = false;

    protected $casts = [
        'records_synced' => 'integer',
        'last_sync' => 'datetime',
    ];
}
