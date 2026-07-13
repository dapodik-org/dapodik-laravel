<?php

namespace Dapodik\Laravel\Eloquent\Models;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demografi extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const DELETED_AT = 'soft_delete';

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    protected $primaryKey = 'demografi_id';

    protected function casts(): array
    {
        return [
            'usia_5' => 'integer',
            'usia_7' => 'integer',
            'usia_13' => 'integer',
            'usia_16' => 'integer',
            'usia_18' => 'integer',
            'jumlah_penduduk' => 'integer',
            'last_sync' => 'datetime',
        ];
    }

    /**
     * public.demografi ← public.vld_demografi (demografi_id → demografi_id).
     */
    public function vldDemografis(): HasMany
    {
        return $this->hasMany(VldDemografi::class, 'demografi_id', 'demografi_id');
    }
}
