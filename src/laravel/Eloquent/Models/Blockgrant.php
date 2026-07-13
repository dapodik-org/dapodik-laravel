<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blockgrant extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'blockgrant_id';

    protected function casts(): array
    {
        return [
            'tahun' => 'decimal',
            'besar_bantuan' => 'decimal',
            'dana_pendamping' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.blockgrant → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.blockgrant ← public.alat_dari_blockgrant (blockgrant_id → blockgrant_id).
     */
    public function alatDariBlockgrants(): HasMany
    {
        return $this->hasMany(AlatDariBlockgrant::class, 'blockgrant_id', 'blockgrant_id');
    }

    /**
     * public.blockgrant ← public.angkutan_dari_blockgrant (blockgrant_id → blockgrant_id).
     */
    public function angkutanDariBlockgrants(): HasMany
    {
        return $this->hasMany(AngkutanDariBlockgrant::class, 'blockgrant_id', 'blockgrant_id');
    }

    /**
     * public.blockgrant ← public.bangunan_dari_blockgrant (blockgrant_id → blockgrant_id).
     */
    public function bangunanDariBlockgrants(): HasMany
    {
        return $this->hasMany(BangunanDariBlockgrant::class, 'blockgrant_id', 'blockgrant_id');
    }

    /**
     * public.blockgrant ← public.tanah_dari_blockgrant (blockgrant_id → blockgrant_id).
     */
    public function tanahDariBlockgrants(): HasMany
    {
        return $this->hasMany(TanahDariBlockgrant::class, 'blockgrant_id', 'blockgrant_id');
    }
}
