<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RwyKerja extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'rwy_kerja_id';

    protected function casts(): array
    {
        return [
            'tgl_sk_kerja' => 'date',
            'tmt_kerja' => 'date',
            'tst_kerja' => 'date',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.rwy_kerja → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.rwy_kerja ← public.vld_rwy_kerja (rwy_kerja_id → rwy_kerja_id).
     */
    public function vldRwyKerjas(): HasMany
    {
        return $this->hasMany(VldRwyKerja::class, 'rwy_kerja_id', 'rwy_kerja_id');
    }
}
