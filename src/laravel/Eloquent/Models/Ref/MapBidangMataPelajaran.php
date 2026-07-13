<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapBidangMataPelajaran extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = ['mata_pelajaran_id', 'bidang_studi_id'];

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.map_bidang_mata_pelajaran → ref.bidang_studi (bidang_studi_id → bidang_studi_id).
     */
    public function bidangStudi(): BelongsTo
    {
        return $this->belongsTo(BidangStudi::class, 'bidang_studi_id', 'bidang_studi_id');
    }

    /**
     * ref.map_bidang_mata_pelajaran → ref.mata_pelajaran (mata_pelajaran_id → mata_pelajaran_id).
     */
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'mata_pelajaran_id');
    }
}
