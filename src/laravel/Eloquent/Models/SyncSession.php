<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SyncSession extends Model
{
    use HasConnection;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'token';

    protected function casts(): array
    {
        return [
            'create_time' => 'datetime',
            'last_activity' => 'datetime',
        ];
    }

    /**
     * public.sync_session → public.instalasi (id_instalasi → id_instalasi).
     */
    public function instalasi(): BelongsTo
    {
        return $this->belongsTo(Instalasi::class, 'id_instalasi', 'id_instalasi');
    }
}
