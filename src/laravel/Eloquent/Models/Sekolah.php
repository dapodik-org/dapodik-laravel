<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sekolah extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'sekolah_id';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'rt' => 'decimal',
            'rw' => 'decimal',
            'lintang' => 'decimal',
            'bujur' => 'decimal',
            'status_sekolah' => 'decimal',
            'tanggal_sk_pendirian' => 'date',
            'tanggal_sk_izin_operasional' => 'date',
            'mbs' => 'boolean',
            'luas_tanah_milik' => 'decimal',
            'luas_tanah_bukan_milik' => 'decimal',
            'keaktifan' => 'boolean',
        ];
    }

    /**
     * public.sekolah → public.yayasan (yayasan_id → yayasan_id).
     */
    public function yayasan(): BelongsTo
    {
        return $this->belongsTo(Yayasan::class, 'yayasan_id', 'yayasan_id');
    }

    /**
     * public.sekolah ← public.akreditasi_sp (sekolah_id → sekolah_id).
     */
    public function akreditasiSps(): HasMany
    {
        return $this->hasMany(AkreditasiSp::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.alat (sekolah_id → sekolah_id).
     */
    public function alats(): HasMany
    {
        return $this->hasMany(Alat::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.anggota_gugus (sekolah_id → sekolah_id).
     */
    public function anggotaGuguses(): HasMany
    {
        return $this->hasMany(AnggotaGugus::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.angkutan (sekolah_id → sekolah_id).
     */
    public function angkutans(): HasMany
    {
        return $this->hasMany(Angkutan::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.bangunan (sekolah_id → sekolah_id).
     */
    public function bangunans(): HasMany
    {
        return $this->hasMany(Bangunan::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.blockgrant (sekolah_id → sekolah_id).
     */
    public function blockgrants(): HasMany
    {
        return $this->hasMany(Blockgrant::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.buku (sekolah_id → sekolah_id).
     */
    public function bukus(): HasMany
    {
        return $this->hasMany(Buku::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.data_dynamic (sekolah_id → sekolah_id).
     */
    public function dataDynamics(): HasMany
    {
        return $this->hasMany(DataDynamic::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.daya_tampung (sekolah_id → sekolah_id).
     */
    public function dayaTampungs(): HasMany
    {
        return $this->hasMany(DayaTampung::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.gugus_sekolah (sekolah_id → sekolah_inti_id).
     */
    public function gugusSekolahs(): HasMany
    {
        return $this->hasMany(GugusSekolah::class, 'sekolah_inti_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.instalasi (sekolah_id → sekolah_id).
     */
    public function instalasis(): HasMany
    {
        return $this->hasMany(Instalasi::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.internet (sekolah_id → sekolah_id).
     */
    public function internets(): HasMany
    {
        return $this->hasMany(Internet::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.izin_operasional (sekolah_id → sekolah_id).
     */
    public function izinOperasionals(): HasMany
    {
        return $this->hasMany(IzinOperasional::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.jurusan_sp (sekolah_id → sekolah_id).
     */
    public function jurusanSps(): HasMany
    {
        return $this->hasMany(JurusanSp::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.kepanitiaan (sekolah_id → sekolah_id).
     */
    public function kepanitiaans(): HasMany
    {
        return $this->hasMany(Kepanitiaan::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.layanan_khusus (sekolah_id → sekolah_id).
     */
    public function layananKhususes(): HasMany
    {
        return $this->hasMany(LayananKhusus::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.listrik (sekolah_id → sekolah_id).
     */
    public function listriks(): HasMany
    {
        return $this->hasMany(Listrik::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.mou (sekolah_id → sekolah_id).
     */
    public function mous(): HasMany
    {
        return $this->hasMany(Mou::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.naungan (sekolah_id → sekolah_id).
     */
    public function naungans(): HasMany
    {
        return $this->hasMany(Naungan::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.peserta_didik_baru (sekolah_id → sekolah_id).
     */
    public function pesertaDidikBarus(): HasMany
    {
        return $this->hasMany(PesertaDidikBaru::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.program_inklusi (sekolah_id → sekolah_id).
     */
    public function programInklusis(): HasMany
    {
        return $this->hasMany(ProgramInklusi::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.ptk_baru (sekolah_id → sekolah_id).
     */
    public function ptkBarus(): HasMany
    {
        return $this->hasMany(PtkBaru::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.ptk_terdaftar (sekolah_id → sekolah_id).
     */
    public function ptkTerdaftars(): HasMany
    {
        return $this->hasMany(PtkTerdaftar::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.registrasi_peserta_didik (sekolah_id → sekolah_id).
     */
    public function registrasiPesertaDidiks(): HasMany
    {
        return $this->hasMany(RegistrasiPesertaDidik::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.rombongan_belajar (sekolah_id → sekolah_id).
     */
    public function rombonganBelajars(): HasMany
    {
        return $this->hasMany(RombonganBelajar::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.ruang (sekolah_id → sekolah_id).
     */
    public function ruangs(): HasMany
    {
        return $this->hasMany(Ruang::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.sanitasi (sekolah_id → sekolah_id).
     */
    public function sanitasis(): HasMany
    {
        return $this->hasMany(Sanitasi::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.sasaran_pengawasan (sekolah_id → sekolah_id).
     */
    public function sasaranPengawasans(): HasMany
    {
        return $this->hasMany(SasaranPengawasan::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.sekolah_longitudinal (sekolah_id → sekolah_id).
     */
    public function sekolahLongitudinals(): HasMany
    {
        return $this->hasMany(SekolahLongitudinal::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.sekolah_paud (sekolah_id → sekolah_id).
     */
    public function sekolahPauds(): HasMany
    {
        return $this->hasMany(SekolahPaud::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.tanah (sekolah_id → sekolah_id).
     */
    public function tanahs(): HasMany
    {
        return $this->hasMany(Tanah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.tugas_tambahan (sekolah_id → sekolah_id).
     */
    public function tugasTambahans(): HasMany
    {
        return $this->hasMany(TugasTambahan::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.unit_usaha (sekolah_id → sekolah_id).
     */
    public function unitUsahas(): HasMany
    {
        return $this->hasMany(UnitUsaha::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah ← public.vld_sekolah (sekolah_id → sekolah_id).
     */
    public function vldSekolahs(): HasMany
    {
        return $this->hasMany(VldSekolah::class, 'sekolah_id', 'sekolah_id');
    }
}
