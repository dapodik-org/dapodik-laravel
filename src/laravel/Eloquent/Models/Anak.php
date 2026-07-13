<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anak extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'anak_id';

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'tahun_masuk' => 'integer',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.anak → public.ptk (ptk_id → ptk_id).
     */
    public function ptk(): BelongsTo
    {
        return $this->belongsTo(Ptk::class, 'ptk_id', 'ptk_id');
    }

    /**
     * public.anak ← public.vld_anak (anak_id → anak_id).
     */
    public function vldAnaks(): HasMany
    {
        return $this->hasMany(VldAnak::class, 'anak_id', 'anak_id');
    }
}
