<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bangunan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_bangunan';

    protected function casts(): array
    {
        return [
            'nup' => 'integer',
            'panjang' => 'float',
            'lebar' => 'float',
            'nilai_perolehan_aset' => 'decimal',
            'jml_lantai' => 'decimal',
            'thn_dibangun' => 'decimal',
            'luas_tapak_bangunan' => 'decimal',
            'vol_pondasi_m3' => 'decimal',
            'vol_sloop_kolom_balok_m3' => 'decimal',
            'panj_kudakuda_m' => 'decimal',
            'vol_kudakuda_m3' => 'decimal',
            'panj_kaso_m' => 'decimal',
            'panj_reng_m' => 'decimal',
            'luas_tutup_atap_m2' => 'decimal',
            'tgl_sk_pemakai' => 'date',
            'tgl_hapus_buku' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.bangunan → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.bangunan → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.bangunan → public.tanah (id_tanah → id_tanah).
     */
    public function tanah(): BelongsTo
    {
        return $this->belongsTo(Tanah::class, 'id_tanah', 'id_tanah');
    }

    /**
     * public.bangunan ← public.bangunan_dari_blockgrant (id_bangunan → id_bangunan).
     */
    public function bangunanDariBlockgrants(): HasMany
    {
        return $this->hasMany(BangunanDariBlockgrant::class, 'id_bangunan', 'id_bangunan');
    }

    /**
     * public.bangunan ← public.bangunan_longitudinal (id_bangunan → id_bangunan).
     */
    public function bangunanLongitudinals(): HasMany
    {
        return $this->hasMany(BangunanLongitudinal::class, 'id_bangunan', 'id_bangunan');
    }

    /**
     * public.bangunan ← public.ruang (id_bangunan → id_bangunan).
     */
    public function ruangs(): HasMany
    {
        return $this->hasMany(Ruang::class, 'id_bangunan', 'id_bangunan');
    }

    /**
     * public.bangunan ← public.vld_bangunan (id_bangunan → id_bangunan).
     */
    public function vldBangunans(): HasMany
    {
        return $this->hasMany(VldBangunan::class, 'id_bangunan', 'id_bangunan');
    }
}
