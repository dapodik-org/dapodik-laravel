<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kesejahteraan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'kesejahteraan_id';

    protected function casts(): array
    {
        return [
            'dari_tahun' => 'decimal',
            'sampai_tahun' => 'decimal',
            'status' => 'integer',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.kesejahteraan → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.kesejahteraan ← public.vld_kesejahteraan (kesejahteraan_id → kesejahteraan_id).
     */
    public function vldKesejahteraans(): HasMany
    {
        return $this->hasMany(VldKesejahteraan::class, 'kesejahteraan_id', 'kesejahteraan_id');
    }
}
