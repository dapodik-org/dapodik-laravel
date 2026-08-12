<?php

namespace Dapodik\Laravel\Eloquent\Models\ManAkses;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Dudi;
use Dapodik\Laravel\Eloquent\Models\LembagaNonSekolah;
use Dapodik\Laravel\Eloquent\Models\Ref\LembagaAkreditasi;
use Dapodik\Laravel\Eloquent\Models\Ref\LembSertifikasi;
use Dapodik\Laravel\Eloquent\Models\Sekolah;
use Dapodik\Laravel\Eloquent\Models\Yayasan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePengguna extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_role_pengguna';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * man_akses.role_pengguna → man_akses.peran (peran_id → peran_id).
     */
    public function peran(): BelongsTo
    {
        return $this->belongsTo(Peran::class, 'peran_id', 'peran_id');
    }

    /**
     * man_akses.role_pengguna ← man_akses.log_otorisasi (id_role_pengguna → id_role_pengguna).
     */
    public function logOtorisasis(): HasMany
    {
        return $this->hasMany(LogOtorisasi::class, 'id_role_pengguna', 'id_role_pengguna');
    }

    /**
     * man_akses.role_pengguna → public.dudi (dudi_id → dudi_id).
     */
    public function dudi(): BelongsTo
    {
        return $this->belongsTo(Dudi::class, 'dudi_id', 'dudi_id');
    }

    /**
     * man_akses.role_pengguna → ref.lemb_sertifikasi (kode_lemb_sert → kode_lemb_sert).
     */
    public function kodeLembSert(): BelongsTo
    {
        return $this->belongsTo(LembSertifikasi::class, 'kode_lemb_sert', 'kode_lemb_sert');
    }

    /**
     * man_akses.role_pengguna → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * man_akses.role_pengguna → public.yayasan (yayasan_id → yayasan_id).
     */
    public function yayasan(): BelongsTo
    {
        return $this->belongsTo(Yayasan::class, 'yayasan_id', 'yayasan_id');
    }

    /**
     * man_akses.role_pengguna → ref.lembaga_akreditasi (la_id → la_id).
     */
    public function la(): BelongsTo
    {
        return $this->belongsTo(LembagaAkreditasi::class, 'la_id', 'la_id');
    }

    /**
     * man_akses.role_pengguna → public.lembaga_non_sekolah (lembaga_id → lembaga_id).
     */
    public function lembaga(): BelongsTo
    {
        return $this->belongsTo(LembagaNonSekolah::class, 'lembaga_id', 'lembaga_id');
    }
}
