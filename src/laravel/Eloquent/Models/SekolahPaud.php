<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
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
}
