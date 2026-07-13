<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelWilayah extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'id_level_wilayah';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
        ];
    }

    /**
     * ref.level_wilayah ← ref.mst_wilayah (id_level_wilayah → id_level_wilayah).
     */
    public function mstWilayahs(): HasMany
    {
        return $this->hasMany(MstWilayah::class, 'id_level_wilayah', 'id_level_wilayah');
    }
}
