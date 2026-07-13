<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tanah extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'id_tanah';

    protected function casts(): array
    {
        return [
            'nup' => 'integer',
            'panjang' => 'float',
            'lebar' => 'float',
            'nilai_perolehan_aset' => 'decimal',
            'rt' => 'decimal',
            'rw' => 'decimal',
            'lintang' => 'decimal',
            'bujur' => 'decimal',
            'tgl_mutasi_keluar' => 'date',
            'luas' => 'decimal',
            'luas_lahan_tersedia' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.tanah → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.tanah ← public.bangunan (id_tanah → id_tanah).
     */
    public function bangunans(): HasMany
    {
        return $this->hasMany(Bangunan::class, 'id_tanah', 'id_tanah');
    }

    /**
     * public.tanah ← public.tanah_dari_blockgrant (id_tanah → id_tanah).
     */
    public function tanahDariBlockgrants(): HasMany
    {
        return $this->hasMany(TanahDariBlockgrant::class, 'id_tanah', 'id_tanah');
    }

    /**
     * public.tanah ← public.tanah_longitudinal (id_tanah → id_tanah).
     */
    public function tanahLongitudinals(): HasMany
    {
        return $this->hasMany(TanahLongitudinal::class, 'id_tanah', 'id_tanah');
    }

    /**
     * public.tanah ← public.vld_tanah (id_tanah → id_tanah).
     */
    public function vldTanahs(): HasMany
    {
        return $this->hasMany(VldTanah::class, 'id_tanah', 'id_tanah');
    }
}
