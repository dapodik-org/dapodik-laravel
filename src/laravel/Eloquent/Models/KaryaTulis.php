<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KaryaTulis extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'karya_tulis_id';

    protected function casts(): array
    {
        return [
            'tahun_pembuatan' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.karya_tulis → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.karya_tulis ← public.vld_karya_tulis (karya_tulis_id → karya_tulis_id).
     */
    public function vldKaryaTulis(): HasMany
    {
        return $this->hasMany(VldKaryaTulis::class, 'karya_tulis_id', 'karya_tulis_id');
    }
}
