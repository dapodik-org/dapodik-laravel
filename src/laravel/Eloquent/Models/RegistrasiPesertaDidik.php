<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrasiPesertaDidik extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'registrasi_id';

    protected function casts(): array
    {
        return [
            'tanggal_masuk_sekolah' => 'date',
            'tanggal_keluar' => 'date',
            'a_pernah_paud' => 'decimal',
            'a_pernah_tk' => 'decimal',
            'id_hobby' => 'decimal',
            'id_cita' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.registrasi_peserta_didik → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.registrasi_peserta_didik → public.jurusan_sp (jurusan_sp_id → jurusan_sp_id).
     */
    public function jurusanSp(): BelongsTo
    {
        return $this->belongsTo(JurusanSp::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }

    /**
     * public.registrasi_peserta_didik → public.peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidik(): BelongsTo
    {
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.registrasi_peserta_didik ← public.anggota_akt_pd (registrasi_id → registrasi_id).
     */
    public function anggotaAktPds(): HasMany
    {
        return $this->hasMany(AnggotaAktPd::class, 'registrasi_id', 'registrasi_id');
    }

    /**
     * public.registrasi_peserta_didik ← public.ijazah_pd (registrasi_id → registrasi_id).
     */
    public function ijazahPds(): HasMany
    {
        return $this->hasMany(IjazahPd::class, 'registrasi_id', 'registrasi_id');
    }

    /**
     * public.registrasi_peserta_didik ← public.tracer_lulusan (registrasi_id → registrasi_id).
     */
    public function tracerLulusans(): HasMany
    {
        return $this->hasMany(TracerLulusan::class, 'registrasi_id', 'registrasi_id');
    }

    /**
     * public.registrasi_peserta_didik ← public.vld_reg_pd (registrasi_id → registrasi_id).
     */
    public function vldRegPds(): HasMany
    {
        return $this->hasMany(VldRegPd::class, 'registrasi_id', 'registrasi_id');
    }
}
