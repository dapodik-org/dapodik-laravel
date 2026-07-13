<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RwyPendFormal extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'riwayat_pendidikan_formal_id';

    protected function casts(): array
    {
        return [
            'kependidikan' => 'decimal',
            'tahun_masuk' => 'decimal',
            'tahun_lulus' => 'decimal',
            'status_kuliah' => 'decimal',
            'semester' => 'decimal',
            'ipk' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.rwy_pend_formal → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.rwy_pend_formal ← public.vld_rwy_pend_formal (riwayat_pendidikan_formal_id → riwayat_pendidikan_formal_id).
     */
    public function vldRwyPendFormals(): HasMany
    {
        return $this->hasMany(VldRwyPendFormal::class, 'riwayat_pendidikan_formal_id', 'riwayat_pendidikan_formal_id');
    }
}
