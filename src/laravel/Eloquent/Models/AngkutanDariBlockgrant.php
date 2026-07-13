<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AngkutanDariBlockgrant extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['blockgrant_id', 'id_angkutan'];

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.angkutan_dari_blockgrant → public.angkutan (id_angkutan → id_angkutan).
     */
    public function angkutan(): BelongsTo
    {
        return $this->belongsTo(Angkutan::class, 'id_angkutan', 'id_angkutan');
    }

    /**
     * public.angkutan_dari_blockgrant → public.blockgrant (blockgrant_id → blockgrant_id).
     */
    public function blockgrant(): BelongsTo
    {
        return $this->belongsTo(Blockgrant::class, 'blockgrant_id', 'blockgrant_id');
    }
}
