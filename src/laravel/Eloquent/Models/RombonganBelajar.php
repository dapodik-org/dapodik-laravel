<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RombonganBelajar extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'rombongan_belajar_id';

    protected function casts(): array
    {
        return [
            'moving_class' => 'decimal',
            'jenis_rombel' => 'decimal',
            'sks' => 'decimal',
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.rombongan_belajar → public.jurusan_sp (jurusan_sp_id → jurusan_sp_id).
     */
    public function jurusanSp(): BelongsTo
    {
        return $this->belongsTo(JurusanSp::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }

    /**
     * public.rombongan_belajar → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.rombongan_belajar → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.rombongan_belajar → public.ruang (id_ruang → id_ruang).
     */
    public function ruang(): BelongsTo
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id_ruang');
    }

    /**
     * public.rombongan_belajar ← public.anggota_rombel (rombongan_belajar_id → rombongan_belajar_id).
     */
    public function anggotaRombels(): HasMany
    {
        return $this->hasMany(AnggotaRombel::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }

    /**
     * public.rombongan_belajar ← public.kelas_ekskul (rombongan_belajar_id → rombongan_belajar_id).
     */
    public function kelasEkskuls(): HasMany
    {
        return $this->hasMany(KelasEkskul::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }

    /**
     * public.rombongan_belajar ← public.pembelajaran (rombongan_belajar_id → rombongan_belajar_id).
     */
    public function pembelajarans(): HasMany
    {
        return $this->hasMany(Pembelajaran::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }

    /**
     * public.rombongan_belajar ← public.vld_rombel (rombongan_belajar_id → rombongan_belajar_id).
     */
    public function vldRombels(): HasMany
    {
        return $this->hasMany(VldRombel::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }
}
