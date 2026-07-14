<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TableSyncLog extends Model
{
    use HasCompositeKey;
    use HasConnection;

    public $incrementing = false;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['table_name', 'id_instalasi'];

    protected function casts(): array
    {
        return [
            'begin_sync' => 'datetime',
            'end_sync' => 'datetime',
            'is_success' => 'decimal',
            'selisih_waktu_server' => 'integer',
            'n_create' => 'integer',
            'n_update' => 'integer',
            'n_hapus' => 'integer',
            'n_konflik' => 'integer',
            'sync_page' => 'integer',
        ];
    }

    /**
     * public.table_sync_log → public.instalasi (id_instalasi → id_instalasi).
     */
    public function instalasi(): BelongsTo
    {
        return $this->belongsTo(Instalasi::class, 'id_instalasi', 'id_instalasi');
    }

    /**
     * public.table_sync_log ← public.sync_primer (id_instalasi → id_instalasi).
     */
    public function syncPrimers(): HasMany
    {
        return $this->hasMany(SyncPrimer::class, 'id_instalasi', 'id_instalasi');
    }
}
