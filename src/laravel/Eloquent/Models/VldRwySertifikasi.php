<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VldRwySertifikasi extends Model
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
     * public.vld_rwy_sertifikasi → public.rwy_sertifikasi (riwayat_sertifikasi_id → riwayat_sertifikasi_id).
     */
    public function riwayatSertifikasi(): BelongsTo
    {
        return $this->belongsTo(RwySertifikasi::class, 'riwayat_sertifikasi_id', 'riwayat_sertifikasi_id');
    }
}
