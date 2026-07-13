<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JurusanSp extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'jurusan_sp_id';

    protected function casts(): array
    {
        return [
            'tanggal_sk_izin' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.jurusan_sp → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.jurusan_sp ← public.akreditasi_prodi (jurusan_sp_id → jurusan_sp_id).
     */
    public function akreditasiProdis(): HasMany
    {
        return $this->hasMany(AkreditasiProdi::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }

    /**
     * public.jurusan_sp ← public.daya_tampung (jurusan_sp_id → jurusan_sp_id).
     */
    public function dayaTampungs(): HasMany
    {
        return $this->hasMany(DayaTampung::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }

    /**
     * public.jurusan_sp ← public.jur_sp_long (jurusan_sp_id → jurusan_sp_id).
     */
    public function jurSpLongs(): HasMany
    {
        return $this->hasMany(JurSpLong::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }

    /**
     * public.jurusan_sp ← public.jurusan_kerjasama (jurusan_sp_id → jurusan_sp_id).
     */
    public function jurusanKerjasamas(): HasMany
    {
        return $this->hasMany(JurusanKerjasama::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }

    /**
     * public.jurusan_sp ← public.registrasi_peserta_didik (jurusan_sp_id → jurusan_sp_id).
     */
    public function registrasiPesertaDidiks(): HasMany
    {
        return $this->hasMany(RegistrasiPesertaDidik::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }

    /**
     * public.jurusan_sp ← public.rombongan_belajar (jurusan_sp_id → jurusan_sp_id).
     */
    public function rombonganBelajars(): HasMany
    {
        return $this->hasMany(RombonganBelajar::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }

    /**
     * public.jurusan_sp ← public.vld_jurusan_sp (jurusan_sp_id → jurusan_sp_id).
     */
    public function vldJurusanSps(): HasMany
    {
        return $this->hasMany(VldJurusanSp::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }
}
