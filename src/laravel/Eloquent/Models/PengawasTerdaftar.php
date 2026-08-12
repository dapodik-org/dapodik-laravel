<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\BidangStudi;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKeluar;
use Dapodik\Laravel\Eloquent\Models\Ref\JenjangKepengawasan;
use Dapodik\Laravel\Eloquent\Models\Ref\MataPelajaran;
use Dapodik\Laravel\Eloquent\Models\Ref\TahunAjaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengawasTerdaftar extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'pengawas_terdaftar_id';

    protected function casts(): array
    {
        return [
            'tanggal_surat_tugas' => 'date',
            'tmt_tugas' => 'date',
            'aktif_bulan_01' => 'decimal',
            'aktif_bulan_02' => 'decimal',
            'aktif_bulan_03' => 'decimal',
            'aktif_bulan_04' => 'decimal',
            'aktif_bulan_05' => 'decimal',
            'aktif_bulan_06' => 'decimal',
            'aktif_bulan_07' => 'decimal',
            'aktif_bulan_08' => 'decimal',
            'aktif_bulan_09' => 'decimal',
            'aktif_bulan_10' => 'decimal',
            'aktif_bulan_11' => 'decimal',
            'aktif_bulan_12' => 'decimal',
            'tgl_pengawas_keluar' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.pengawas_terdaftar → public.lembaga_non_sekolah (lembaga_id → lembaga_id).
     */
    public function lembaga(): BelongsTo
    {
        return $this->belongsTo(LembagaNonSekolah::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * public.pengawas_terdaftar → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.pengawas_terdaftar ← public.guru_sasaran_pengawas (pengawas_terdaftar_id → pengawas_terdaftar_id).
     */
    public function guruSasaranPengawas(): HasMany
    {
        return $this->hasMany(GuruSasaranPengawas::class, 'pengawas_terdaftar_id', 'pengawas_terdaftar_id');
    }

    /**
     * public.pengawas_terdaftar ← public.sasaran_pengawasan (pengawas_terdaftar_id → pengawas_terdaftar_id).
     */
    public function sasaranPengawasans(): HasMany
    {
        return $this->hasMany(SasaranPengawasan::class, 'pengawas_terdaftar_id', 'pengawas_terdaftar_id');
    }

    /**
     * public.pengawas_terdaftar → ref.bidang_studi (bidang_studi_id → bidang_studi_id).
     */
    public function bidangStudi(): BelongsTo
    {
        return $this->belongsTo(BidangStudi::class, 'bidang_studi_id', 'bidang_studi_id');
    }

    /**
     * public.pengawas_terdaftar → ref.jenis_keluar (jenis_keluar_id → jenis_keluar_id).
     */
    public function jenisKeluar(): BelongsTo
    {
        return $this->belongsTo(JenisKeluar::class, 'jenis_keluar_id', 'jenis_keluar_id');
    }

    /**
     * public.pengawas_terdaftar → ref.mata_pelajaran (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    /**
     * public.pengawas_terdaftar → ref.tahun_ajaran (tahun_ajaran_id → tahun_ajaran_id).
     */
    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }

    /**
     * public.pengawas_terdaftar → ref.jenjang_kepengawasan (jenjang_kepengawasan_id → jenjang_kepengawasan_id).
     */
    public function jenjangKepengawasan(): BelongsTo
    {
        return $this->belongsTo(JenjangKepengawasan::class, 'jenjang_kepengawasan_id', 'jenjang_kepengawasan_id');
    }
}
