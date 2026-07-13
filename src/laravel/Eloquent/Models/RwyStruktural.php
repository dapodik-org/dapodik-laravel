<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RwyStruktural extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'riwayat_struktural_id';

    protected function casts(): array
    {
        return [
            'tmt_jabatan' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.rwy_struktural → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.rwy_struktural ← public.vld_rwy_struktural (riwayat_struktural_id → riwayat_struktural_id).
     */
    public function vldRwyStrukturals(): HasMany
    {
        return $this->hasMany(VldRwyStruktural::class, 'riwayat_struktural_id', 'riwayat_struktural_id');
    }
}
