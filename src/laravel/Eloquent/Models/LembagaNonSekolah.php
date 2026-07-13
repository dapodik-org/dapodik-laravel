<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LembagaNonSekolah extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'lembaga_id';

    protected function casts(): array
    {
        return [
            'rt' => 'decimal',
            'rw' => 'decimal',
            'lintang' => 'decimal',
            'bujur' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.lembaga_non_sekolah ← public.izin_operasional (lembaga_id → lembaga_id).
     */
    public function izinOperasionals(): HasMany
    {
        return $this->hasMany(IzinOperasional::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * public.lembaga_non_sekolah ← public.naungan (lembaga_id → lembaga_id).
     */
    public function naungans(): HasMany
    {
        return $this->hasMany(Naungan::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * public.lembaga_non_sekolah ← public.pengawas_terdaftar (lembaga_id → lembaga_id).
     */
    public function pengawasTerdaftars(): HasMany
    {
        return $this->hasMany(PengawasTerdaftar::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * public.lembaga_non_sekolah ← public.vld_nonsekolah (lembaga_id → lembaga_id).
     */
    public function vldNonsekolahs(): HasMany
    {
        return $this->hasMany(VldNonsekolah::class, 'lembaga_id', 'lembaga_id');
    }
}
