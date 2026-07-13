<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesertaDidik extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'peserta_didik_id';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'tanggal_lahir' => 'date',
            'rt' => 'decimal',
            'rw' => 'decimal',
            'lintang' => 'decimal',
            'bujur' => 'decimal',
            'anak_keberapa' => 'decimal',
            'penerima_kps' => 'boolean',
            'layak_pip' => 'boolean',
            'penerima_kip' => 'boolean',
            'tahun_lahir_ayah' => 'decimal',
            'tahun_lahir_ibu' => 'decimal',
            'tahun_lahir_wali' => 'decimal',
        ];
    }

    /**
     * public.peserta_didik ← public.anggota_panitia (peserta_didik_id → peserta_didik_id).
     */
    public function anggotaPanitias(): HasMany
    {
        return $this->hasMany(AnggotaPanitia::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.anggota_rombel (peserta_didik_id → peserta_didik_id).
     */
    public function anggotaRombels(): HasMany
    {
        return $this->hasMany(AnggotaRombel::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.beasiswa_peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function beasiswaPesertaDidiks(): HasMany
    {
        return $this->hasMany(BeasiswaPesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.kesejahteraan_pd (peserta_didik_id → peserta_didik_id).
     */
    public function kesejahteraanPds(): HasMany
    {
        return $this->hasMany(KesejahteraanPd::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.kitas_pd (peserta_didik_id → peserta_didik_id).
     */
    public function kitasPds(): HasMany
    {
        return $this->hasMany(KitasPd::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.paspor_pd (peserta_didik_id → peserta_didik_id).
     */
    public function pasporPds(): HasMany
    {
        return $this->hasMany(PasporPd::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.peserta_didik_baru (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidikBarus(): HasMany
    {
        return $this->hasMany(PesertaDidikBaru::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.peserta_didik_longitudinal (peserta_didik_id → peserta_didik_id).
     */
    public function pesertaDidikLongitudinals(): HasMany
    {
        return $this->hasMany(PesertaDidikLongitudinal::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.prestasi (peserta_didik_id → peserta_didik_id).
     */
    public function prestasis(): HasMany
    {
        return $this->hasMany(Prestasi::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.registrasi_peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function registrasiPesertaDidiks(): HasMany
    {
        return $this->hasMany(RegistrasiPesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.sertifikasi_pd (peserta_didik_id → peserta_didik_id).
     */
    public function sertifikasiPds(): HasMany
    {
        return $this->hasMany(SertifikasiPd::class, 'peserta_didik_id', 'peserta_didik_id');
    }

    /**
     * public.peserta_didik ← public.vld_peserta_didik (peserta_didik_id → peserta_didik_id).
     */
    public function vldPesertaDidiks(): HasMany
    {
        return $this->hasMany(VldPesertaDidik::class, 'peserta_didik_id', 'peserta_didik_id');
    }
}
