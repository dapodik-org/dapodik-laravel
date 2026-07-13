<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mulok extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = ['kode_wilayah', 'mata_pelajaran_id'];

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'tgl_sk_mulok' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.mulok → ref.mata_pelajaran (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }

    /**
     * ref.mulok → ref.mst_wilayah (kode_wilayah → kode_wilayah).
     */
    public function kodeWilayah(): BelongsTo
    {
        return $this->belongsTo(MstWilayah::class, 'kode_wilayah', 'kode_wilayah');
    }
}
