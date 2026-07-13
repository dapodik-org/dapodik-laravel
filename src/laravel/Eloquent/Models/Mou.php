<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mou extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'mou_id';

    protected function casts(): array
    {
        return [
            'id_jns_ks' => 'decimal',
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.mou → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.mou → public.dudi (dudi_id → dudi_id).
     */
    public function dudi(): BelongsTo
    {
        return $this->belongsTo(Dudi::class, 'dudi_id', 'dudi_id');
    }

    /**
     * public.mou ← public.akt_pd (mou_id → mou_id).
     */
    public function aktPds(): HasMany
    {
        return $this->hasMany(AktPd::class, 'mou_id', 'mou_id');
    }

    /**
     * public.mou ← public.jurusan_kerjasama (mou_id → mou_id).
     */
    public function jurusanKerjasamas(): HasMany
    {
        return $this->hasMany(JurusanKerjasama::class, 'mou_id', 'mou_id');
    }

    /**
     * public.mou ← public.unit_usaha_kerjasama (mou_id → mou_id).
     */
    public function unitUsahaKerjasamas(): HasMany
    {
        return $this->hasMany(UnitUsahaKerjasama::class, 'mou_id', 'mou_id');
    }

    /**
     * public.mou ← public.vld_mou (mou_id → mou_id).
     */
    public function vldMous(): HasMany
    {
        return $this->hasMany(VldMou::class, 'mou_id', 'mou_id');
    }
}
