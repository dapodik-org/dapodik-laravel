<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisBantuan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'jenis_bantuan_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'untuk_sekolah' => 'boolean',
            'untuk_pd' => 'boolean',
        ];
    }

    /**
     * ref.jenis_bantuan ← ref.sasaran_blockgrant (jenis_bantuan_id → jenis_bantuan_id).
     */
    public function sasaranBlockgrants(): HasMany
    {
        return $this->hasMany(SasaranBlockgrant::class, 'jenis_bantuan_id', 'jenis_bantuan_id');
    }
}
