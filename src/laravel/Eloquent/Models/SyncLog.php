<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SyncLog extends Model
{
    use HasCompositeKey;
    use HasConnection;
    public $incrementing = false;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['id_instalasi', 'begin_sync'];

    protected function casts(): array
    {
        return [
            'begin_sync' => 'datetime',
            'end_sync' => 'datetime',
            'is_success' => 'decimal',
            'selisih_waktu_server' => 'integer',
        ];
    }

    /**
     * public.sync_log → public.instalasi (id_instalasi → id_instalasi).
     */
    public function instalasi(): BelongsTo
    {
        return $this->belongsTo(Instalasi::class, 'id_instalasi', 'id_instalasi');
    }
}
