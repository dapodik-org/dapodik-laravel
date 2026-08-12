<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\BidangStudi;
use Dapodik\Laravel\Eloquent\Models\Ref\GelarAkademik;
use Dapodik\Laravel\Eloquent\Models\Ref\JenjangPendidikan;
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

    /**
     * public.rwy_pend_formal → ref.gelar_akademik (gelar_akademik_id → gelar_akademik_id).
     */
    public function gelarAkademik(): BelongsTo
    {
        return $this->belongsTo(GelarAkademik::class, 'gelar_akademik_id', 'gelar_akademik_id');
    }

    /**
     * public.rwy_pend_formal → ref.bidang_studi (bidang_studi_id → bidang_studi_id).
     */
    public function bidangStudi(): BelongsTo
    {
        return $this->belongsTo(BidangStudi::class, 'bidang_studi_id', 'bidang_studi_id');
    }

    /**
     * public.rwy_pend_formal → ref.jenjang_pendidikan (jenjang_pendidikan_id → jenjang_pendidikan_id).
     */
    public function jenjangPendidikan(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_id', 'jenjang_pendidikan_id');
    }
}
