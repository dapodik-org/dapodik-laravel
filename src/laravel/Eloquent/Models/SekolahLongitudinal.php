<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
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
}
