<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Negara extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'negara_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'luar_negeri' => 'boolean',
        ];
    }

    /**
     * ref.negara ← ref.mst_wilayah (negara_id → negara_id).
     */
    public function mstWilayahs(): HasMany
    {
        return $this->hasMany(MstWilayah::class, 'negara_id', 'negara_id');
    }
}
