<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\Ref\TahunAjaran;
use Dapodik\Laravel\Eloquent\Models\Ref\TingkatPendidikan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DayaTampung extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'daya_tampung_id';

    protected function casts(): array
    {
        return [
            'jumlah_rombel' => 'integer',
            'jumlah_siswa_min' => 'integer',
            'jumlah_siswa_max' => 'integer',
            'is_lock' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.daya_tampung → public.jurusan_sp (jurusan_sp_id → jurusan_sp_id).
     */
    public function jurusanSp(): BelongsTo
    {
        return $this->belongsTo(JurusanSp::class, 'jurusan_sp_id', 'jurusan_sp_id');
    }

    /**
     * public.daya_tampung → public.sekolah (sekolah_id → sekolah_id).
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }

    /**
     * public.daya_tampung → ref.tahun_ajaran (tahun_ajaran_id → tahun_ajaran_id).
     */
    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }

    /**
     * public.daya_tampung → ref.tingkat_pendidikan (tingkat_pendidikan_id → tingkat_pendidikan_id).
     */
    public function tingkatPendidikan(): BelongsTo
    {
        return $this->belongsTo(TingkatPendidikan::class, 'tingkat_pendidikan_id', 'tingkat_pendidikan_id');
    }
}
