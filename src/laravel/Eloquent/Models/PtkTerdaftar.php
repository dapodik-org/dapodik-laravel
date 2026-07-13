<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PtkTerdaftar extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'ptk_terdaftar_id';

    protected function casts(): array
    {
        return [
            'tanggal_surat_tugas' => 'date',
            'ptk_induk' => 'decimal',
            'tmt_tugas' => 'date',
            'aktif_bulan_01' => 'decimal',
            'aktif_bulan_02' => 'decimal',
            'aktif_bulan_03' => 'decimal',
            'aktif_bulan_04' => 'decimal',
            'aktif_bulan_05' => 'decimal',
            'aktif_bulan_06' => 'decimal',
            'aktif_bulan_07' => 'decimal',
            'aktif_bulan_08' => 'decimal',
            'aktif_bulan_09' => 'decimal',
            'aktif_bulan_10' => 'decimal',
            'aktif_bulan_11' => 'decimal',
            'aktif_bulan_12' => 'decimal',
            'tgl_ptk_keluar' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.ptk_terdaftar → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.ptk_terdaftar → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk_terdaftar ← public.guru_sasaran_pengawas (ptk_terdaftar_id → ptk_terdaftar_id).
     */
    public function guruSasaranPengawas(): HasMany
    {
        return $this->hasMany(GuruSasaranPengawas::class, 'ptk_terdaftar_id', 'ptk_terdaftar_id');
    }

    /**
     * public.ptk_terdaftar ← public.pembelajaran (ptk_terdaftar_id → ptk_terdaftar_id).
     */
    public function pembelajarans(): HasMany
    {
        return $this->hasMany(Pembelajaran::class, 'ptk_terdaftar_id', 'ptk_terdaftar_id');
    }

    /**
     * public.ptk_terdaftar ← public.vld_ptk_terdaftar (ptk_terdaftar_id → ptk_terdaftar_id).
     */
    public function vldPtkTerdaftars(): HasMany
    {
        return $this->hasMany(VldPtkTerdaftar::class, 'ptk_terdaftar_id', 'ptk_terdaftar_id');
    }
}
