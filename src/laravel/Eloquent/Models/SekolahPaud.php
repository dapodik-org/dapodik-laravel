<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\BentukLembaga;
use Dapodik\Laravel\Eloquent\Models\Ref\FasilitasLayanan;
use Dapodik\Laravel\Eloquent\Models\Ref\JadwalPaud;
use Dapodik\Laravel\Eloquent\Models\Ref\KategoriTk;
use Dapodik\Laravel\Eloquent\Models\Ref\KlasifikasiLembaga;
use Dapodik\Laravel\Eloquent\Models\Ref\LembagaPengangkat;
use Dapodik\Laravel\Eloquent\Models\Ref\Semester;
use Dapodik\Laravel\Eloquent\Models\Ref\SumberDanaSekolah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SekolahPaud extends Model
{
    use HasCompositeKey;
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = ['sekolah_id', 'semester_id'];

    protected function casts(): array
    {
        return [
            'jadwal_pmtas' => 'decimal',
            'jadwal_ddtk' => 'decimal',
            'freq_parenting' => 'decimal',
            'jadwal_kesehatan' => 'decimal',
            'izin_paud' => 'decimal',
            'pencatatan_ddtk' => 'decimal',
            'rujukan_ddtk' => 'decimal',
            'pelaksanaan_parenting' => 'decimal',
            'parenting_kpo' => 'decimal',
            'parenting_kelas' => 'decimal',
            'parenting_kegiatan' => 'decimal',
            'parenting_konsultasi' => 'decimal',
            'parenting_kunjungan' => 'decimal',
            'parenting_lainnya' => 'decimal',
            'tanggal_penetapan_pnf' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.sekolah_paud → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah_paud → ref.bentuk_lembaga (bentuk_lembaga_id → bentuk_lembaga_id).
     */
    public function bentukLembaga(): BelongsTo
    {
        return $this->belongsTo(BentukLembaga::class, 'bentuk_lembaga_id', 'bentuk_lembaga_id');
    }

    /**
     * public.sekolah_paud → ref.fasilitas_layanan (fasilitas_layanan_id → fasilitas_layanan_id).
     */
    public function fasilitasLayanan(): BelongsTo
    {
        return $this->belongsTo(FasilitasLayanan::class, 'fasilitas_layanan_id', 'fasilitas_layanan_id');
    }

    /**
     * public.sekolah_paud → ref.jadwal_paud (freq_parenting → jadwal_id).
     */
    public function freqParenting(): BelongsTo
    {
        return $this->belongsTo(JadwalPaud::class, 'freq_parenting', 'jadwal_id');
    }

    /**
     * public.sekolah_paud → ref.jadwal_paud (jadwal_ddtk → jadwal_id).
     */
    public function jadwalDdtk(): BelongsTo
    {
        return $this->belongsTo(JadwalPaud::class, 'jadwal_ddtk', 'jadwal_id');
    }

    /**
     * public.sekolah_paud → ref.jadwal_paud (jadwal_kesehatan → jadwal_id).
     */
    public function jadwalKesehatan(): BelongsTo
    {
        return $this->belongsTo(JadwalPaud::class, 'jadwal_kesehatan', 'jadwal_id');
    }

    /**
     * public.sekolah_paud → ref.jadwal_paud (jadwal_pmtas → jadwal_id).
     */
    public function jadwalPmtas(): BelongsTo
    {
        return $this->belongsTo(JadwalPaud::class, 'jadwal_pmtas', 'jadwal_id');
    }

    /**
     * public.sekolah_paud → ref.kategori_tk (kategori_tk_id → kategori_tk_id).
     */
    public function kategoriTk(): BelongsTo
    {
        return $this->belongsTo(KategoriTk::class, 'kategori_tk_id', 'kategori_tk_id');
    }

    /**
     * public.sekolah_paud → ref.klasifikasi_lembaga (klasifikasi_lembaga_id → klasifikasi_lembaga_id).
     */
    public function klasifikasiLembaga(): BelongsTo
    {
        return $this->belongsTo(KlasifikasiLembaga::class, 'klasifikasi_lembaga_id', 'klasifikasi_lembaga_id');
    }

    /**
     * public.sekolah_paud → ref.lembaga_pengangkat (lembaga_pengangkat_id → lembaga_pengangkat_id).
     */
    public function lembagaPengangkat(): BelongsTo
    {
        return $this->belongsTo(LembagaPengangkat::class, 'lembaga_pengangkat_id', 'lembaga_pengangkat_id');
    }

    /**
     * public.sekolah_paud → ref.semester (semester_id → semester_id).
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }

    /**
     * public.sekolah_paud → ref.sumber_dana_sekolah (sumber_dana_sekolah_id → sumber_dana_sekolah_id).
     */
    public function sumberDanaSekolah(): BelongsTo
    {
        return $this->belongsTo(SumberDanaSekolah::class, 'sumber_dana_sekolah_id', 'sumber_dana_sekolah_id');
    }
}
