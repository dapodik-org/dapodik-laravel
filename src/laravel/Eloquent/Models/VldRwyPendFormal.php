<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VldRwyPendFormal extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'logid';

    protected function casts(): array
    {
        return [
            'idtype' => 'integer',
            'status_validasi' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.vld_rwy_pend_formal → public.rwy_pend_formal (riwayat_pendidikan_formal_id → riwayat_pendidikan_formal_id).
     */
    public function riwayatPendidikanFormal(): BelongsTo
    {
        return $this->belongsTo(RwyPendFormal::class, 'riwayat_pendidikan_formal_id', 'riwayat_pendidikan_formal_id');
    }
}
