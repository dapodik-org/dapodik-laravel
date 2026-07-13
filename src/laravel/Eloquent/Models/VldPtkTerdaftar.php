<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VldPtkTerdaftar extends Model
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
     * public.vld_ptk_terdaftar → public.ptk_terdaftar (ptk_terdaftar_id → ptk_terdaftar_id).
     */
    public function ptkTerdaftar(): BelongsTo
    {
        return $this->belongsTo(PtkTerdaftar::class, 'ptk_terdaftar_id', 'ptk_terdaftar_id');
    }
}
