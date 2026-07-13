<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dudi extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'dudi_id';

    protected function casts(): array
    {
        return [
            'rt' => 'decimal',
            'rw' => 'decimal',
            'lintang' => 'decimal',
            'bujur' => 'decimal',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.dudi ← public.mou (dudi_id → dudi_id).
     */
    public function mous(): HasMany
    {
        return $this->hasMany(Mou::class, 'dudi_id', 'dudi_id');
    }

    /**
     * public.dudi ← public.tracer_lulusan (dudi_id → dudi_id).
     */
    public function tracerLulusans(): HasMany
    {
        return $this->hasMany(TracerLulusan::class, 'dudi_id', 'dudi_id');
    }

    /**
     * public.dudi ← public.vld_dudi (dudi_id → dudi_id).
     */
    public function vldDudis(): HasMany
    {
        return $this->hasMany(VldDudi::class, 'dudi_id', 'dudi_id');
    }
}
