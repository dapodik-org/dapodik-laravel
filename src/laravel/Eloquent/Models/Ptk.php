<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Blob\LargeObject;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Dapodik\Laravel\Eloquent\Models\Ref\Bank;
use Dapodik\Laravel\Eloquent\Models\Ref\BidangStudi;
use Dapodik\Laravel\Eloquent\Models\Ref\KeahlianLaboratorium;
use Dapodik\Laravel\Eloquent\Models\Ref\KebutuhanKhusus;
use Dapodik\Laravel\Eloquent\Models\Ref\LembagaPengangkat;
use Dapodik\Laravel\Eloquent\Models\Ref\MstWilayah;
use Dapodik\Laravel\Eloquent\Models\Ref\Negara;
use Dapodik\Laravel\Eloquent\Models\Ref\PangkatGolongan;
use Dapodik\Laravel\Eloquent\Models\Ref\Pekerjaan;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusKeaktifanPegawai;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusKepegawaian;
use Dapodik\Laravel\Eloquent\Models\Ref\SumberGaji;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ptk extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'ptk_id';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'tanggal_lahir' => 'date',
            'rt' => 'decimal',
            'rw' => 'decimal',
            'lintang' => 'decimal',
            'bujur' => 'decimal',
            'tgl_cpns' => 'date',
            'tmt_pengangkatan' => 'date',
            'status_perkawinan' => 'decimal',
            'tmt_pns' => 'date',
            'sudah_lisensi_kepala_sekolah' => 'boolean',
            'pernah_diklat_kepengawasan' => 'boolean',
            'keahlian_braille' => 'boolean',
            'keahlian_bhs_isyarat' => 'boolean',
        ];
    }

    /**
     * public.ptk ← public.alat (ptk_id → ptk_id).
     */
    public function alats(): HasMany
    {
        return $this->hasMany(Alat::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.anak (ptk_id → ptk_id).
     */
    public function anaks(): HasMany
    {
        return $this->hasMany(Anak::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.anggota_panitia (ptk_id → ptk_id).
     */
    public function anggotaPanitias(): HasMany
    {
        return $this->hasMany(AnggotaPanitia::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.angkutan (ptk_id → ptk_id).
     */
    public function angkutans(): HasMany
    {
        return $this->hasMany(Angkutan::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.bangunan (ptk_id → ptk_id).
     */
    public function bangunans(): HasMany
    {
        return $this->hasMany(Bangunan::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.beasiswa_ptk (ptk_id → ptk_id).
     */
    public function beasiswaPtks(): HasMany
    {
        return $this->hasMany(BeasiswaPtk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.bidang_sdm (ptk_id → ptk_id).
     */
    public function bidangSdms(): HasMany
    {
        return $this->hasMany(BidangSdm::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.bimbing_pd (ptk_id → ptk_id).
     */
    public function bimbingPds(): HasMany
    {
        return $this->hasMany(BimbingPd::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.buku_ptk (ptk_id → ptk_id).
     */
    public function bukuPtks(): HasMany
    {
        return $this->hasMany(BukuPtk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.diklat (ptk_id → ptk_id).
     */
    public function diklats(): HasMany
    {
        return $this->hasMany(Diklat::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.inpassing (ptk_id → ptk_id).
     */
    public function inpassings(): HasMany
    {
        return $this->hasMany(Inpassing::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.karya_tulis (ptk_id → ptk_id).
     */
    public function karyaTulis(): HasMany
    {
        return $this->hasMany(KaryaTulis::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.kesejahteraan (ptk_id → ptk_id).
     */
    public function kesejahteraans(): HasMany
    {
        return $this->hasMany(Kesejahteraan::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.kitas_ptk (ptk_id → ptk_id).
     */
    public function kitasPtks(): HasMany
    {
        return $this->hasMany(KitasPtk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.nilai_test (ptk_id → ptk_id).
     */
    public function nilaiTests(): HasMany
    {
        return $this->hasMany(NilaiTest::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.paspor_ptk (ptk_id → ptk_id).
     */
    public function pasporPtks(): HasMany
    {
        return $this->hasMany(PasporPtk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.pengawas_terdaftar (ptk_id → ptk_id).
     */
    public function pengawasTerdaftars(): HasMany
    {
        return $this->hasMany(PengawasTerdaftar::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.penghargaan (ptk_id → ptk_id).
     */
    public function penghargaans(): HasMany
    {
        return $this->hasMany(Penghargaan::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.ptk_baru (ptk_id → ptk_id).
     */
    public function ptkBarus(): HasMany
    {
        return $this->hasMany(PtkBaru::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.ptk_terdaftar (ptk_id → ptk_id).
     */
    public function ptkTerdaftars(): HasMany
    {
        return $this->hasMany(PtkTerdaftar::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.riwayat_gaji_berkala (ptk_id → ptk_id).
     */
    public function riwayatGajiBerkalas(): HasMany
    {
        return $this->hasMany(RiwayatGajiBerkala::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.rombongan_belajar (ptk_id → ptk_id).
     */
    public function rombonganBelajars(): HasMany
    {
        return $this->hasMany(RombonganBelajar::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.rwy_fungsional (ptk_id → ptk_id).
     */
    public function rwyFungsionals(): HasMany
    {
        return $this->hasMany(RwyFungsional::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.rwy_kepangkatan (ptk_id → ptk_id).
     */
    public function rwyKepangkatans(): HasMany
    {
        return $this->hasMany(RwyKepangkatan::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.rwy_kerja (ptk_id → ptk_id).
     */
    public function rwyKerjas(): HasMany
    {
        return $this->hasMany(RwyKerja::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.rwy_pend_formal (ptk_id → ptk_id).
     */
    public function rwyPendFormals(): HasMany
    {
        return $this->hasMany(RwyPendFormal::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.rwy_sertifikasi (ptk_id → ptk_id).
     */
    public function rwySertifikasis(): HasMany
    {
        return $this->hasMany(RwySertifikasi::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.rwy_struktural (ptk_id → ptk_id).
     */
    public function rwyStrukturals(): HasMany
    {
        return $this->hasMany(RwyStruktural::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.tugas_tambahan (ptk_id → ptk_id).
     */
    public function tugasTambahans(): HasMany
    {
        return $this->hasMany(TugasTambahan::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.tunjangan (ptk_id → ptk_id).
     */
    public function tunjangans(): HasMany
    {
        return $this->hasMany(Tunjangan::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk ← public.vld_ptk (ptk_id → ptk_id).
     */
    public function vldPtks(): HasMany
    {
        return $this->hasMany(VldPtk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.ptk → ref.negara (kewarganegaraan → negara_id).
     */
    public function kewarganegaraan(): BelongsTo
    {
        return $this->belongsTo(Negara::class, 'kewarganegaraan', 'negara_id');
    }

    /**
     * public.ptk → ref.bank (id_bank → id_bank).
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'id_bank', 'id_bank');
    }

    /**
     * public.ptk → blob.large_object (blob_id → blob_id).
     */
    public function blob(): BelongsTo
    {
        return $this->belongsTo(LargeObject::class, 'blob_id', 'blob_id');
    }

    /**
     * public.ptk → ref.mst_wilayah (kode_wilayah → kode_wilayah).
     */
    public function kodeWilayah(): BelongsTo
    {
        return $this->belongsTo(MstWilayah::class, 'kode_wilayah', 'kode_wilayah');
    }

    /**
     * public.ptk → ref.kebutuhan_khusus (kebutuhan_khusus_id → kebutuhan_khusus_id).
     */
    public function kebutuhanKhusus(): BelongsTo
    {
        return $this->belongsTo(KebutuhanKhusus::class, 'kebutuhan_khusus_id', 'kebutuhan_khusus_id');
    }

    /**
     * public.ptk → ref.kebutuhan_khusus (mampu_handle_kk → kebutuhan_khusus_id).
     */
    public function mampuHandleKk(): BelongsTo
    {
        return $this->belongsTo(KebutuhanKhusus::class, 'mampu_handle_kk', 'kebutuhan_khusus_id');
    }

    /**
     * public.ptk → ref.lembaga_pengangkat (lembaga_pengangkat_id → lembaga_pengangkat_id).
     */
    public function lembagaPengangkat(): BelongsTo
    {
        return $this->belongsTo(LembagaPengangkat::class, 'lembaga_pengangkat_id', 'lembaga_pengangkat_id');
    }

    /**
     * public.ptk → ref.status_keaktifan_pegawai (status_keaktifan_id → status_keaktifan_id).
     */
    public function statusKeaktifan(): BelongsTo
    {
        return $this->belongsTo(StatusKeaktifanPegawai::class, 'status_keaktifan_id', 'status_keaktifan_id');
    }

    /**
     * public.ptk → ref.sumber_gaji (sumber_gaji_id → sumber_gaji_id).
     */
    public function sumberGaji(): BelongsTo
    {
        return $this->belongsTo(SumberGaji::class, 'sumber_gaji_id', 'sumber_gaji_id');
    }

    /**
     * public.ptk → ref.pangkat_golongan (pangkat_golongan_id → pangkat_golongan_id).
     */
    public function pangkatGolongan(): BelongsTo
    {
        return $this->belongsTo(PangkatGolongan::class, 'pangkat_golongan_id', 'pangkat_golongan_id');
    }

    /**
     * public.ptk → ref.bidang_studi (pengawas_bidang_studi_id → bidang_studi_id).
     */
    public function pengawasBidangStudi(): BelongsTo
    {
        return $this->belongsTo(BidangStudi::class, 'pengawas_bidang_studi_id', 'bidang_studi_id');
    }

    /**
     * public.ptk → ref.keahlian_laboratorium (keahlian_laboratorium_id → keahlian_laboratorium_id).
     */
    public function keahlianLaboratorium(): BelongsTo
    {
        return $this->belongsTo(KeahlianLaboratorium::class, 'keahlian_laboratorium_id', 'keahlian_laboratorium_id');
    }

    /**
     * public.ptk → ref.pekerjaan (pekerjaan_suami_istri → pekerjaan_id).
     */
    public function pekerjaanSuamiIstri(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_suami_istri', 'pekerjaan_id');
    }

    /**
     * public.ptk → ref.agama (agama_id → agama_id).
     */
    public function agama(): BelongsTo
    {
        return $this->belongsTo(Agama::class, 'agama_id', 'agama_id');
    }

    /**
     * public.ptk → ref.status_kepegawaian (status_kepegawaian_id → status_kepegawaian_id).
     */
    public function statusKepegawaian(): BelongsTo
    {
        return $this->belongsTo(StatusKepegawaian::class, 'status_kepegawaian_id', 'status_kepegawaian_id');
    }
}
