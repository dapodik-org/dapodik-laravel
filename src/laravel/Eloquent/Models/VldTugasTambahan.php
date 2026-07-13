<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VldTugasTambahan extends Model
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
            'status_validasi' => 'decimal',
            'idtype' => 'integer',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.vld_tugas_tambahan → public.tugas_tambahan (ptk_tugas_tambahan_id → ptk_tugas_tambahan_id).
     */
    public function ptkTugasTambahan(): BelongsTo
    {
        return $this->belongsTo(TugasTambahan::class, 'ptk_tugas_tambahan_id', 'ptk_tugas_tambahan_id');
    }
}
