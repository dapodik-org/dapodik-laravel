<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Dapodik\Laravel\Eloquent\Models\Ref\AlasanLayakPip;
use Dapodik\Laravel\Eloquent\Models\Ref\AlatTransportasi;
use Dapodik\Laravel\Eloquent\Models\Ref\Bank;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisTinggal;
use Dapodik\Laravel\Eloquent\Models\Ref\JenjangPendidikan;
use Dapodik\Laravel\Eloquent\Models\Ref\KebutuhanKhusus;
use Dapodik\Laravel\Eloquent\Models\Ref\MstWilayah;
use Dapodik\Laravel\Eloquent\Models\Ref\Negara;
use Dapodik\Laravel\Eloquent\Models\Ref\Pekerjaan;
use Dapodik\Laravel\Eloquent\Models\Ref\Penghasilan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    /**
     * public.peserta_didik → ref.kebutuhan_khusus (kebutuhan_khusus_id_ayah → kebutuhan_khusus_id).
     */
    public function kebutuhanKhususAyah(): BelongsTo
    {
        return $this->belongsTo(KebutuhanKhusus::class, 'kebutuhan_khusus_id_ayah', 'kebutuhan_khusus_id');
    }

    /**
     * public.peserta_didik → ref.kebutuhan_khusus (kebutuhan_khusus_id_ibu → kebutuhan_khusus_id).
     */
    public function kebutuhanKhususIbu(): BelongsTo
    {
        return $this->belongsTo(KebutuhanKhusus::class, 'kebutuhan_khusus_id_ibu', 'kebutuhan_khusus_id');
    }

    /**
     * public.peserta_didik → ref.negara (kewarganegaraan → negara_id).
     */
    public function kewarganegaraan(): BelongsTo
    {
        return $this->belongsTo(Negara::class, 'kewarganegaraan', 'negara_id');
    }

    /**
     * public.peserta_didik → ref.alasan_layak_pip (id_layak_pip → id_layak_pip).
     */
    public function layakPip(): BelongsTo
    {
        return $this->belongsTo(AlasanLayakPip::class, 'id_layak_pip', 'id_layak_pip');
    }

    /**
     * public.peserta_didik → ref.bank (id_bank → id_bank).
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'id_bank', 'id_bank');
    }

    /**
     * public.peserta_didik → ref.mst_wilayah (kode_wilayah → kode_wilayah).
     */
    public function kodeWilayah(): BelongsTo
    {
        return $this->belongsTo(MstWilayah::class, 'kode_wilayah', 'kode_wilayah');
    }

    /**
     * public.peserta_didik → ref.kebutuhan_khusus (kebutuhan_khusus_id → kebutuhan_khusus_id).
     */
    public function kebutuhanKhusus(): BelongsTo
    {
        return $this->belongsTo(KebutuhanKhusus::class, 'kebutuhan_khusus_id', 'kebutuhan_khusus_id');
    }

    /**
     * public.peserta_didik → ref.pekerjaan (pekerjaan_id → pekerjaan_id).
     */
    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id', 'pekerjaan_id');
    }

    /**
     * public.peserta_didik → ref.agama (agama_id → agama_id).
     */
    public function agama(): BelongsTo
    {
        return $this->belongsTo(Agama::class, 'agama_id', 'agama_id');
    }

    /**
     * public.peserta_didik → ref.penghasilan (penghasilan_id_ayah → penghasilan_id).
     */
    public function penghasilanAyah(): BelongsTo
    {
        return $this->belongsTo(Penghasilan::class, 'penghasilan_id_ayah', 'penghasilan_id');
    }

    /**
     * public.peserta_didik → ref.jenis_tinggal (jenis_tinggal_id → jenis_tinggal_id).
     */
    public function jenisTinggal(): BelongsTo
    {
        return $this->belongsTo(JenisTinggal::class, 'jenis_tinggal_id', 'jenis_tinggal_id');
    }

    /**
     * public.peserta_didik → ref.alat_transportasi (alat_transportasi_id → alat_transportasi_id).
     */
    public function alatTransportasi(): BelongsTo
    {
        return $this->belongsTo(AlatTransportasi::class, 'alat_transportasi_id', 'alat_transportasi_id');
    }

    /**
     * public.peserta_didik → ref.pekerjaan (pekerjaan_id_ayah → pekerjaan_id).
     */
    public function pekerjaanAyah(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id_ayah', 'pekerjaan_id');
    }

    /**
     * public.peserta_didik → ref.jenjang_pendidikan (jenjang_pendidikan_ibu → jenjang_pendidikan_id).
     */
    public function jenjangPendidikanIbu(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_ibu', 'jenjang_pendidikan_id');
    }

    /**
     * public.peserta_didik → ref.penghasilan (penghasilan_id_wali → penghasilan_id).
     */
    public function penghasilanWali(): BelongsTo
    {
        return $this->belongsTo(Penghasilan::class, 'penghasilan_id_wali', 'penghasilan_id');
    }

    /**
     * public.peserta_didik → ref.pekerjaan (pekerjaan_id_ibu → pekerjaan_id).
     */
    public function pekerjaanIbu(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id_ibu', 'pekerjaan_id');
    }

    /**
     * public.peserta_didik → ref.jenjang_pendidikan (jenjang_pendidikan_ayah → jenjang_pendidikan_id).
     */
    public function jenjangPendidikanAyah(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_ayah', 'jenjang_pendidikan_id');
    }

    /**
     * public.peserta_didik → ref.penghasilan (penghasilan_id_ibu → penghasilan_id).
     */
    public function penghasilanIbu(): BelongsTo
    {
        return $this->belongsTo(Penghasilan::class, 'penghasilan_id_ibu', 'penghasilan_id');
    }

    /**
     * public.peserta_didik → ref.pekerjaan (pekerjaan_id_wali → pekerjaan_id).
     */
    public function pekerjaanWali(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id_wali', 'pekerjaan_id');
    }

    /**
     * public.peserta_didik → ref.jenjang_pendidikan (jenjang_pendidikan_wali → jenjang_pendidikan_id).
     */
    public function jenjangPendidikanWali(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_wali', 'jenjang_pendidikan_id');
    }
}
