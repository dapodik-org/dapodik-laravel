<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TanahDariBlockgrant extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['blockgrant_id', 'id_tanah'];

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.tanah_dari_blockgrant → public.blockgrant (blockgrant_id → blockgrant_id).
     */
    public function blockgrant(): BelongsTo
    {
        return $this->belongsTo(Blockgrant::class, 'blockgrant_id', 'blockgrant_id');
    }

    /**
     * public.tanah_dari_blockgrant → public.tanah (id_tanah → id_tanah).
     */
    public function tanah(): BelongsTo
    {
        return $this->belongsTo(Tanah::class, 'id_tanah', 'id_tanah');
    }
}
