<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SyncPrimer extends Model
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
            'id_thread' => 'integer',
            'sync_status' => 'integer',
        ];
    }

    /**
     * public.sync_primer → public.table_sync_log (table_name → id_instalasi).
     */
    public function tableName(): BelongsTo
    {
        return $this->belongsTo(TableSyncLog::class, 'table_name', 'id_instalasi');
    }

    /**
     * public.sync_primer → public.table_sync_log (id_instalasi → table_name).
     */
    public function instalasi(): BelongsTo
    {
        return $this->belongsTo(TableSyncLog::class, 'id_instalasi', 'table_name');
    }
}
