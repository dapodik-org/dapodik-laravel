<?php

namespace Dapodik\Laravel\Eloquent\Models\Ref;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BentukPendidikan extends Model
{
    use HasConnection;
    use SoftDeletes;

    public const CREATED_AT = 'create_date';

    public const UPDATED_AT = 'last_update';

    public const DELETED_AT = 'expired_date';

    protected $primaryKey = 'bentuk_pendidikan_id';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'last_sync' => 'datetime',
            'jenjang_paud' => 'boolean',
            'jenjang_tk' => 'boolean',
            'jenjang_sd' => 'boolean',
            'jenjang_smp' => 'boolean',
            'jenjang_sma' => 'boolean',
            'jenjang_tinggi' => 'boolean',
            'aktif' => 'boolean',
        ];
    }

    /**
     * ref.bentuk_pendidikan ← ref.standar_sarana (bentuk_pendidikan_id → bentuk_pendidikan_id).
     */
    public function standarSaranas(): HasMany
    {
        return $this->hasMany(StandarSarana::class, 'bentuk_pendidikan_id', 'bentuk_pendidikan_id');
    }
}
