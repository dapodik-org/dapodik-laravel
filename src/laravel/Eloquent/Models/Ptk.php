<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
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
}
