<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BeasiswaPtk extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'beasiswa_ptk_id';

    protected function casts(): array
    {
        return [
            'tahun_mulai' => 'decimal',
            'tahun_akhir' => 'decimal',
            'masih_menerima' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.beasiswa_ptk → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.beasiswa_ptk ← public.vld_bea_ptk (beasiswa_ptk_id → beasiswa_ptk_id).
     */
    public function vldBeaPtks(): HasMany
    {
        return $this->hasMany(VldBeaPtk::class, 'beasiswa_ptk_id', 'beasiswa_ptk_id');
    }
}
