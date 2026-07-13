<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BukuPtk extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'buku_id';

    protected function casts(): array
    {
        return [
            'tahun' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.buku_ptk → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.buku_ptk ← public.vld_buku_ptk (buku_id → buku_id).
     */
    public function vldBukuPtks(): HasMany
    {
        return $this->hasMany(VldBukuPtk::class, 'buku_id', 'buku_id');
    }
}
