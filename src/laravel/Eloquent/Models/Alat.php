<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alat extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_alat';

    protected function casts(): array
    {
        return [
            'nup' => 'integer',
            'tgl_hapus_buku' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.alat → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.alat → public.ruang (id_ruang → id_ruang).
     */
    public function ruang(): BelongsTo
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.alat → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.alat ← public.alat_dari_blockgrant (id_alat → id_alat).
     */
    public function alatDariBlockgrants(): HasMany
    {
        return $this->hasMany(AlatDariBlockgrant::class, 'id_alat', 'id_alat');
    }

    /**
     * public.alat ← public.alat_longitudinal (id_alat → id_alat).
     */
    public function alatLongitudinals(): HasMany
    {
        return $this->hasMany(AlatLongitudinal::class, 'id_alat', 'id_alat');
    }

    /**
     * public.alat ← public.vld_alat (id_alat → id_alat).
     */
    public function vldAlats(): HasMany
    {
        return $this->hasMany(VldAlat::class, 'id_alat', 'id_alat');
    }
}
