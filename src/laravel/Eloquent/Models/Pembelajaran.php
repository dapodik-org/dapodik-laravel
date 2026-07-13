<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelajaran extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'pembelajaran_id';

    protected function casts(): array
    {
        return [
            'tanggal_sk_mengajar' => 'date',
            'jam_mengajar_per_minggu' => 'decimal',
            'status_di_kurikulum' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.pembelajaran → public.rombongan_belajar (rombongan_belajar_id → rombongan_belajar_id).
     */
    public function rombonganBelajar(): BelongsTo
    {
        return $this->belongsTo(RombonganBelajar::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }

    /**
     * public.pembelajaran → public.ptk_terdaftar (ptk_terdaftar_id → ptk_terdaftar_id).
     */
    public function ptkTerdaftar(): BelongsTo
    {
        return $this->belongsTo(PtkTerdaftar::class, 'ptk_terdaftar_id', 'ptk_terdaftar_id');
    }

    /**
     * public.pembelajaran ← public.buku_pelajaran (pembelajaran_id → pembelajaran_id).
     */
    public function bukuPelajarans(): HasMany
    {
        return $this->hasMany(BukuPelajaran::class, 'pembelajaran_id', 'pembelajaran_id');
    }

    /**
     * public.pembelajaran ← public.jadwal (pembelajaran_id → bel_ke_20).
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'bel_ke_20', 'pembelajaran_id');
    }

    /**
     * public.pembelajaran ← public.vld_pembelajaran (pembelajaran_id → pembelajaran_id).
     */
    public function vldPembelajarans(): HasMany
    {
        return $this->hasMany(VldPembelajaran::class, 'pembelajaran_id', 'pembelajaran_id');
    }

    /**
     * public.pembelajaran → public.rombongan_belajar (rombongan_belajar_id → rombongan_belajar_id).
     */

    /**
     * public.pembelajaran → public.pembelajaran (induk_pembelajaran_id → pembelajaran_id).
     */
    public function indukPembelajaran(): BelongsTo
    {
        return $this->belongsTo(self::class, 'induk_pembelajaran_id', 'pembelajaran_id');
    }

    /**
     * public.pembelajaran → public.ptk_terdaftar (ptk_terdaftar_id → ptk_terdaftar_id).
     */

    /**
     * public.pembelajaran ← public.buku_pelajaran (pembelajaran_id → pembelajaran_id).
     */

    /**
     * public.pembelajaran ← public.jadwal (pembelajaran_id → bel_ke_20).
     */

    /**
     * public.pembelajaran ← public.pembelajaran (pembelajaran_id → induk_pembelajaran_id).
     */
    public function pembelajarans(): HasMany
    {
        return $this->hasMany(self::class, 'induk_pembelajaran_id', 'pembelajaran_id');
    }

    /*
     * public.pembelajaran ← public.vld_pembelajaran (pembelajaran_id → pembelajaran_id)
     */
}
