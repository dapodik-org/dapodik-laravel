<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RwySertifikasi extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'riwayat_sertifikasi_id';

    protected function casts(): array
    {
        return [
            'kode_lemb_sert' => 'decimal',
            'id_jenis_sertifikasi' => 'decimal',
            'tgl_sert' => 'date',
            'tgl_exp_sert' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.rwy_sertifikasi → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.rwy_sertifikasi ← public.vld_rwy_sertifikasi (riwayat_sertifikasi_id → riwayat_sertifikasi_id).
     */
    public function vldRwySertifikasis(): HasMany
    {
        return $this->hasMany(VldRwySertifikasi::class, 'riwayat_sertifikasi_id', 'riwayat_sertifikasi_id');
    }
}
