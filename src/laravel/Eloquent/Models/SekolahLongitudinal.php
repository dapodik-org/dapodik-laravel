<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Blob\LargeObject;
use Dapodik\Laravel\Eloquent\Models\Ref\AksesInternet;
use Dapodik\Laravel\Eloquent\Models\Ref\Semester;
use Dapodik\Laravel\Eloquent\Models\Ref\SertifikasiIso;
use Dapodik\Laravel\Eloquent\Models\Ref\SumberListrik;
use Dapodik\Laravel\Eloquent\Models\Ref\WaktuPenyelenggaraan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SekolahLongitudinal extends Model
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
            'jarak_listrik' => 'decimal',
            'wilayah_terpencil' => 'decimal',
            'wilayah_perbatasan' => 'decimal',
            'wilayah_transmigrasi' => 'decimal',
            'wilayah_adat_terpencil' => 'decimal',
            'wilayah_bencana_alam' => 'decimal',
            'wilayah_bencana_sosial' => 'decimal',
            'partisipasi_bos' => 'decimal',
            'daya_listrik' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.sekolah_longitudinal → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.sekolah_longitudinal ← public.jadwal (semester_id → semester_id).
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'semester_id', 'semester_id');
    }

    /**
     * public.sekolah_longitudinal → blob.large_object (blob_id → blob_id).
     */
    public function blob(): BelongsTo
    {
        return $this->belongsTo(LargeObject::class, 'blob_id', 'blob_id');
    }

    /**
     * public.sekolah_longitudinal → ref.sertifikasi_iso (sertifikasi_iso_id → sertifikasi_iso_id).
     */
    public function sertifikasiIso(): BelongsTo
    {
        return $this->belongsTo(SertifikasiIso::class, 'sertifikasi_iso_id', 'sertifikasi_iso_id');
    }

    /**
     * public.sekolah_longitudinal → ref.semester (semester_id → semester_id).
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'semester_id');
    }

    /**
     * public.sekolah_longitudinal → ref.sumber_listrik (sumber_listrik_id → sumber_listrik_id).
     */
    public function sumberListrik(): BelongsTo
    {
        return $this->belongsTo(SumberListrik::class, 'sumber_listrik_id', 'sumber_listrik_id');
    }

    /**
     * public.sekolah_longitudinal → ref.waktu_penyelenggaraan (waktu_penyelenggaraan_id → waktu_penyelenggaraan_id).
     */
    public function waktuPenyelenggaraan(): BelongsTo
    {
        return $this->belongsTo(WaktuPenyelenggaraan::class, 'waktu_penyelenggaraan_id', 'waktu_penyelenggaraan_id');
    }

    /**
     * public.sekolah_longitudinal → ref.akses_internet (akses_internet_id → akses_internet_id).
     */
    public function aksesInternet(): BelongsTo
    {
        return $this->belongsTo(AksesInternet::class, 'akses_internet_id', 'akses_internet_id');
    }

    /**
     * public.sekolah_longitudinal → ref.akses_internet (akses_internet_2_id → akses_internet_id).
     */
    public function aksesInternet2(): BelongsTo
    {
        return $this->belongsTo(AksesInternet::class, 'akses_internet_2_id', 'akses_internet_id');
    }
}
