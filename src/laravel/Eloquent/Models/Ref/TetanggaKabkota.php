<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TetanggaKabkota extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = ['kode_wilayah1', 'kode_wilayah2'];

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.tetangga_kabkota → ref.mst_wilayah (kode_wilayah2 → kode_wilayah).
     */
    public function kodeWilayah2(): BelongsTo
    {
        return $this->belongsTo(MstWilayah::class, 'kode_wilayah2', 'kode_wilayah');
    }

    /**
     * ref.tetangga_kabkota → ref.mst_wilayah (kode_wilayah1 → kode_wilayah).
     */
    public function kodeWilayah1(): BelongsTo
    {
        return $this->belongsTo(MstWilayah::class, 'kode_wilayah1', 'kode_wilayah');
    }
}
