<?php

namespace Dapodik\Laravel\Eloquent\Models\ManAkses;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Dudi;
use Dapodik\Laravel\Eloquent\Models\LembagaNonSekolah;
use Dapodik\Laravel\Eloquent\Models\PesertaDidik;
use Dapodik\Laravel\Eloquent\Models\Ref\LembagaAkreditasi;
use Dapodik\Laravel\Eloquent\Models\Ref\LembSertifikasi;
use Dapodik\Laravel\Eloquent\Models\Ref\MstWilayah;
use Dapodik\Laravel\Eloquent\Models\Yayasan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengguna extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'soft_delete';

    protected $primaryKey = 'pengguna_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * man_akses.pengguna ← man_akses.log_otentikasi (pengguna_id → pengguna_id).
     */
    public function logOtentikasis(): HasMany
    {
        return $this->hasMany(LogOtentikasi::class, 'pengguna_id', 'pengguna_id');
    }

    /**
     * man_akses.pengguna → ref.lembaga_akreditasi (la_id → la_id).
     */
    public function la(): BelongsTo
    {
        return $this->belongsTo(LembagaAkreditasi::class, 'la_id', 'la_id');
    }

    /**
     * man_akses.pengguna → ref.mst_wilayah (kode_wilayah → kode_wilayah).
     */
    public function kodeWilayah(): BelongsTo
    {
        return $this->belongsTo(MstWilayah::class, 'kode_wilayah', 'kode_wilayah');
    }

    /**
     * man_akses.pengguna → public.lembaga_non_sekolah (lembaga_id → lembaga_id).
     */
    public function lembaga(): BelongsTo
    {
        return $this->belongsTo(LembagaNonSekolah::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * man_akses.pengguna → public.dudi (dudi_id → dudi_id).
     */
    public function dudi(): BelongsTo
    {
        return $this->belongsTo(Dudi::class, 'dudi_id', 'dudi_id');
    }

    /**
     * man_akses.pengguna → ref.lemb_sertifikasi (kode_lemb_sert → kode_lemb_sert).
     */
    public function kodeLembSert(): BelongsTo
    {
        return $this->belongsTo(LembSertifikasi::class, 'kode_lemb_sert', 'kode_lemb_sert');
    }

    /**
     * man_akses.pengguna → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * man_akses.pengguna → public.yayasan (yayasan_id → yayasan_id).
     */
    public function yayasan(): BelongsTo
    {
        return $this->belongsTo(Yayasan::class, 'yayasan_id', 'yayasan_id');
    }
}
